<?php
namespace Dandomain\Api\Command;

use Memio\Model\FullyQualifiedName;
use Memio\Model\Phpdoc\Description;
use Memio\Model\Phpdoc\MethodPhpdoc;
use Memio\Model\Phpdoc\ParameterTag;
use Memio\Model\Phpdoc\PropertyPhpdoc;
use Memio\Model\Phpdoc\ReturnTag;
use Memio\Model\Phpdoc\VariableTag;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Memio\Memio\Config\Build;
use Memio\Model\File;
use Memio\Model\Object;
use Memio\Model\Property;
use Memio\Model\Method;
use Memio\Model\Argument;

class CreateEntityFromJsonCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName('generate:entity')
            ->setDescription('Will generate an entity based on JSON input')
            ->addArgument(
                'file',
                InputArgument::REQUIRED,
                'JSON file'
            )
            ->addArgument(
                'entity',
                InputArgument::REQUIRED,
                'The name of the entity'
            )
            ->addArgument(
                'entity-dir',
                InputArgument::REQUIRED,
                'The entity directory'
            )
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $file       = $input->getArgument('file');
        $entity     = $input->getArgument('entity');
        $entityDir  = $input->getArgument('entity-dir');

        if(!file_exists($file)) {
            throw new \InvalidArgumentException("$file does not exist");
        }

        if(!is_dir($entityDir)) {
            throw new \InvalidArgumentException("$entityDir is not a valid directory");
        }

        $item = json_decode(file_get_contents($file))[0];

        $file = File::make($entityDir . '/' . $entity . '.php');
        $object = Object::make('Dandomain\\Api\\Entity\\' . $entity);

        $arrayProperties = [];
        foreach($item as $key => $val) {
            if (gettype($val) == 'array') {
                $arrayProperties[] = $key;
            }
        }

        if(count($arrayProperties)) {
            $body = [];
            foreach($arrayProperties as $arrayProperty) {
                $body[] = '        $this->' . $arrayProperty . ' = new ArrayCollection();';
            }
            $object->addMethod(
                Method::make('__construct')->setBody(join("\n", $body))
            );

            $file->addFullyQualifiedName(new FullyQualifiedName('Doctrine\Common\Collections\ArrayCollection'));
        }

        foreach($item as $key => $val) {
            $type       = gettype($val);

            if($type == 'array') {
                $type = 'ArrayCollection';
            }

            $property   = Property::make($key)
                ->makeProtected()
                ->setPhpdoc(
                    PropertyPhpdoc::make()
                        ->setVariableTag(new VariableTag($type))
                );

            $object->addProperty($property);

            $object->addMethod(
                Method::make('get' . ucfirst($key))
                    ->setPhpdoc(MethodPhpdoc::make()
                        ->setReturnTag(new ReturnTag($type))
                    )
                    ->setBody('        return $this->' . $key . ';')
            );

            $object->addMethod(
                Method::make('set' . ucfirst($key))
                    ->setPhpdoc(MethodPhpdoc::make()
                        ->addParameterTag(new ParameterTag($type, $key))
                        ->setReturnTag(new ReturnTag($entity))
                    )
                    ->addArgument(Argument::make('string', $key))
                    ->setBody('        $this->' . $key . ' = $' . $key . ';'))
            ;
        }

        $file->setStructure($object);

        $prettyPrinter = Build::prettyPrinter();
        $generatedCode = $prettyPrinter->generateCode($file);

        file_put_contents($file->getFilename(), $generatedCode);
    }
}