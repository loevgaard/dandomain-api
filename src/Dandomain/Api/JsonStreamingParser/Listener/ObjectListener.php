<?php
namespace Dandomain\Api\JsonStreamingParser\Listener;

/**
 * This implementation allows to process an object at a specific level
 * when it has been fully parsed
 */
class ObjectListener implements \JsonStreamingParser_Listener {

    /** @var string Current key **/
    private $_key;

    /** @var int Array deep level **/
    private $array_level = 0;
    /** @var int Object deep level **/
    private $object_level = 0;

    /** @var array Pointer that aliases the current array that represents an object or an array **/
    private $pointer;

    /**
     * @var array $array_pointers Stores different array pointers according to the deep level
     * @var array $object_pointers Stores different objects pointers according to the deep level
     * Those are used to track pointers, it's easy to go forward or backwards by using this
     * As they are only pointers, in PHP "aliases" they shouldn't eat much memory even with big objects
     */
    private $array_pointers, $object_pointers;

    /** @var array Main array that stores the current building object **/
    private $stack = array();

    private $callback, $end_callback;

    /**
     * @param callable $callback the function called when a json object has been fully parsed
     * @param callable $end_callback
     * @throws \InvalidArgumentException if callback isn't callable
     */
    public function __construct($callback, $end_callback)
    {
        if(!is_callable($callback)) {
            throw new \InvalidArgumentException("Callback should be a callable function");
        }

        $this->callback = $callback;
        $this->end_callback = $end_callback;
    }

    public function file_position($line, $char) {
    }

    /**
     * Document start
     * Init every variables and place the pointer on the stack
     *
     * @return void
     */
    public function start_document() {

        $this->stack = array();
        $this->array_pointers = array();
        $this->array_level = 0;
        $this->object_level = 0;
        $this->object_pointers = array();
        $this->keys = array();
        $this->_key = null;

        $this->pointer =& $this->stack;
    }

    /**
     * Document end (EOF)
     *
     * @return void
     */
    public function end_document() {
        // release memory
        $this->start_document();

        if(is_callable($this->end_callback)) {
            call_user_func_array($this->end_callback, []);
        }
    }

    /**
     * Start object
     * An object began...
     *
     * @return void
     */
    public function start_object() {
        //Increase the object level
        $this->object_level++;

        //Point on the current array
        $this->pointer =& $this->array_pointers[$this->array_level];

        //Get the current index
        $array_index = isset($this->pointer) ? count($this->pointer) : 0;

        //Build an array on this index
        $this->pointer[$array_index] = array();

        //Pointer is now this new array
        $this->pointer =& $this->pointer[$array_index];

        //Store it
        $this->object_pointers[$this->object_level] =& $this->pointer;
    }

    /**
     * End Object
     * An object ended
     *
     * @return void
     */
    public function end_object() {

        $this->pointer =& $this->array_pointers[$this->array_level];

        //We've reach a full object on my root array, callback
        if($this->array_level == 1 && $this->object_level == 1) {
            call_user_func_array($this->callback, [$this->stack[0]]);
            array_shift($this->stack[0]); //release this item from memory
        }

        $this->object_level--;
    }

    /**
     * Start array
     * An array began...
     *
     * @return void
     */
    public function start_array() {
        $this->array_level++;

        //If we have a key it's our index
        if($this->_key) {
            $index = $this->_key;
            $this->_key = null;
        } else {
            $index = isset($this->pointer) ? count($this->pointer) : 0;
        }

        //This is our array, point on it
        $this->pointer[$index] = array();
        $this->pointer =& $this->pointer[$index];

        //Store the pointer
        $this->array_pointers[$this->array_level] =& $this->pointer;

    }

    /**
     * End array
     *
     * Now it ended...
     * @todo, according to both levels, point to the nearest one array or object
     * @return void
     */
    public function end_array() {
        //Point on the last known object
        $this->pointer =& $this->object_pointers[$this->object_level];
        $this->array_level--;
    }

    /**
     * Called when a key is founded
     * @param string $key
     * @return void
     */
    public function key($key) {
        $this->_key = $key;
    }

    /**
     * Called when a value is founded
     * @param mixed $value may be a string, integer, boolean, null
     * @return void
     */
    public function value($value) {

        if($this->_key) {
            $this->pointer[$this->_key] = $value;
        } else {
            $this->pointer[] = $value;
        }
    }

    public function whitespace($whitespace) {
    }
}