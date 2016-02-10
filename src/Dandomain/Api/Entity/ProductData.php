<?php

namespace Dandomain\Api\Entity;

use Doctrine\Common\Collections\ArrayCollection;

class ProductData
{
    /**
     * @var string
     */
    protected $barCodeNumber;

    /**
     * @var ArrayCollection
     */
    protected $categoryIdList;

    /**
     * @var string
     */
    protected $comments;

    /**
     * @var double
     */
    protected $costPrice;

    /**
     * @var string
     */
    protected $created;

    /**
     * @var string
     */
    protected $createdBy;

    /**
     * @var null
     */
    protected $defaultCategoryId;

    /**
     * @var ArrayCollection
     */
    protected $disabledVariantIdList;

    /**
     * @var ArrayCollection
     */
    protected $disabledVariants;

    /**
     * @var string
     */
    protected $edbPriserProductNumber;

    /**
     * @var string
     */
    protected $fileSaleLink;

    /**
     * @var string
     */
    protected $googleFeedCategory;

    /**
     * @var int
     */
    protected $id;

    /**
     * @var bool
     */
    protected $isGiftCertificate;

    /**
     * @var bool
     */
    protected $isModified;

    /**
     * @var bool
     */
    protected $isRateVariants;

    /**
     * @var bool
     */
    protected $isReviewVariants;

    /**
     * @var bool
     */
    protected $isVariantMaster;

    /**
     * @var string
     */
    protected $locationNumber;

    /**
     * @var ArrayCollection
     */
    protected $manufacturereIdList;

    /**
     * @var ArrayCollection
     */
    protected $manufacturers;

    /**
     * @var int
     */
    protected $maxBuyAmount;

    /**
     * @var ArrayCollection
     */
    protected $media;

    /**
     * @var int
     */
    protected $minBuyAmount;

    /**
     * @var int
     */
    protected $minBuyAmountB2B;

    /**
     * @var string
     */
    protected $number;

    /**
     * @var string
     */
    protected $picture;

    /**
     * @var ArrayCollection
     */
    protected $prices;

    /**
     * @var ArrayCollection
     */
    protected $productCategories;

    /**
     * @var ArrayCollection
     */
    protected $productRelations;

    /**
     * @var object
     */
    protected $productType;

    /**
     * @var int
     */
    protected $salesCount;

    /**
     * @var ArrayCollection
     */
    protected $segmentIdList;

    /**
     * @var ArrayCollection
     */
    protected $segments;

    /**
     * @var ArrayCollection
     */
    protected $siteSettings;

    /**
     * @var int
     */
    protected $sortOrder;

    /**
     * @var int
     */
    protected $stockCount;

    /**
     * @var int
     */
    protected $stockLimit;

    /**
     * @var int
     */
    protected $typeId;

    /**
     * @var string
     */
    protected $updated;

    /**
     * @var string
     */
    protected $updatedBy;

    /**
     * @var ArrayCollection
     */
    protected $variantGroupIdList;

    /**
     * @var ArrayCollection
     */
    protected $variantGroups;

    /**
     * @var ArrayCollection
     */
    protected $variantIdList;

    /**
     * @var string
     */
    protected $variantMasterId;

    /**
     * @var ArrayCollection
     */
    protected $variants;

    /**
     * @var string
     */
    protected $vendorNumber;

    /**
     * @var double
     */
    protected $weight;

    public function __construct()
    {
        $this->categoryIdList = new ArrayCollection();
        $this->disabledVariantIdList = new ArrayCollection();
        $this->disabledVariants = new ArrayCollection();
        $this->manufacturereIdList = new ArrayCollection();
        $this->manufacturers = new ArrayCollection();
        $this->media = new ArrayCollection();
        $this->prices = new ArrayCollection();
        $this->productCategories = new ArrayCollection();
        $this->productRelations = new ArrayCollection();
        $this->segmentIdList = new ArrayCollection();
        $this->segments = new ArrayCollection();
        $this->siteSettings = new ArrayCollection();
        $this->variantGroupIdList = new ArrayCollection();
        $this->variantGroups = new ArrayCollection();
        $this->variantIdList = new ArrayCollection();
        $this->variants = new ArrayCollection();
    }

    /**
     * @return string
     */
    public function getBarCodeNumber()
    {
        return $this->barCodeNumber;
    }

    /**
     * @param string $barCodeNumber
     *
     * @return ProductData
     */
    public function setBarCodeNumber($barCodeNumber)
    {
        $this->barCodeNumber = $barCodeNumber;
    }

    /**
     * @return ArrayCollection
     */
    public function getCategoryIdList()
    {
        return $this->categoryIdList;
    }

    /**
     * @param ArrayCollection $categoryIdList
     *
     * @return ProductData
     */
    public function setCategoryIdList($categoryIdList)
    {
        $this->categoryIdList = $categoryIdList;
    }

    /**
     * @return string
     */
    public function getComments()
    {
        return $this->comments;
    }

    /**
     * @param string $comments
     *
     * @return ProductData
     */
    public function setComments($comments)
    {
        $this->comments = $comments;
    }

    /**
     * @return double
     */
    public function getCostPrice()
    {
        return $this->costPrice;
    }

    /**
     * @param double $costPrice
     *
     * @return ProductData
     */
    public function setCostPrice($costPrice)
    {
        $this->costPrice = $costPrice;
    }

    /**
     * @return string
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * @param string $created
     *
     * @return ProductData
     */
    public function setCreated($created)
    {
        $this->created = $created;
    }

    /**
     * @return string
     */
    public function getCreatedBy()
    {
        return $this->createdBy;
    }

    /**
     * @param string $createdBy
     *
     * @return ProductData
     */
    public function setCreatedBy($createdBy)
    {
        $this->createdBy = $createdBy;
    }

    /**
     * @return NULL
     */
    public function getDefaultCategoryId()
    {
        return $this->defaultCategoryId;
    }

    /**
     * @param null $defaultCategoryId
     *
     * @return ProductData
     */
    public function setDefaultCategoryId($defaultCategoryId)
    {
        $this->defaultCategoryId = $defaultCategoryId;
    }

    /**
     * @return ArrayCollection
     */
    public function getDisabledVariantIdList()
    {
        return $this->disabledVariantIdList;
    }

    /**
     * @param ArrayCollection $disabledVariantIdList
     *
     * @return ProductData
     */
    public function setDisabledVariantIdList($disabledVariantIdList)
    {
        $this->disabledVariantIdList = $disabledVariantIdList;
    }

    /**
     * @return ArrayCollection
     */
    public function getDisabledVariants()
    {
        return $this->disabledVariants;
    }

    /**
     * @param ArrayCollection $disabledVariants
     *
     * @return ProductData
     */
    public function setDisabledVariants($disabledVariants)
    {
        $this->disabledVariants = $disabledVariants;
    }

    /**
     * @return string
     */
    public function getEdbPriserProductNumber()
    {
        return $this->edbPriserProductNumber;
    }

    /**
     * @param string $edbPriserProductNumber
     *
     * @return ProductData
     */
    public function setEdbPriserProductNumber($edbPriserProductNumber)
    {
        $this->edbPriserProductNumber = $edbPriserProductNumber;
    }

    /**
     * @return string
     */
    public function getFileSaleLink()
    {
        return $this->fileSaleLink;
    }

    /**
     * @param string $fileSaleLink
     *
     * @return ProductData
     */
    public function setFileSaleLink($fileSaleLink)
    {
        $this->fileSaleLink = $fileSaleLink;
    }

    /**
     * @return string
     */
    public function getGoogleFeedCategory()
    {
        return $this->googleFeedCategory;
    }

    /**
     * @param string $googleFeedCategory
     *
     * @return ProductData
     */
    public function setGoogleFeedCategory($googleFeedCategory)
    {
        $this->googleFeedCategory = $googleFeedCategory;
    }

    /**
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     *
     * @return ProductData
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return boolean
     */
    public function getIsGiftCertificate()
    {
        return $this->isGiftCertificate;
    }

    /**
     * @param bool $isGiftCertificate
     *
     * @return ProductData
     */
    public function setIsGiftCertificate($isGiftCertificate)
    {
        $this->isGiftCertificate = $isGiftCertificate;
    }

    /**
     * @return boolean
     */
    public function getIsModified()
    {
        return $this->isModified;
    }

    /**
     * @param bool $isModified
     *
     * @return ProductData
     */
    public function setIsModified($isModified)
    {
        $this->isModified = $isModified;
    }

    /**
     * @return boolean
     */
    public function getIsRateVariants()
    {
        return $this->isRateVariants;
    }

    /**
     * @param bool $isRateVariants
     *
     * @return ProductData
     */
    public function setIsRateVariants($isRateVariants)
    {
        $this->isRateVariants = $isRateVariants;
    }

    /**
     * @return boolean
     */
    public function getIsReviewVariants()
    {
        return $this->isReviewVariants;
    }

    /**
     * @param bool $isReviewVariants
     *
     * @return ProductData
     */
    public function setIsReviewVariants($isReviewVariants)
    {
        $this->isReviewVariants = $isReviewVariants;
    }

    /**
     * @return boolean
     */
    public function getIsVariantMaster()
    {
        return $this->isVariantMaster;
    }

    /**
     * @param bool $isVariantMaster
     *
     * @return ProductData
     */
    public function setIsVariantMaster($isVariantMaster)
    {
        $this->isVariantMaster = $isVariantMaster;
    }

    /**
     * @return string
     */
    public function getLocationNumber()
    {
        return $this->locationNumber;
    }

    /**
     * @param string $locationNumber
     *
     * @return ProductData
     */
    public function setLocationNumber($locationNumber)
    {
        $this->locationNumber = $locationNumber;
    }

    /**
     * @return ArrayCollection
     */
    public function getManufacturereIdList()
    {
        return $this->manufacturereIdList;
    }

    /**
     * @param ArrayCollection $manufacturereIdList
     *
     * @return ProductData
     */
    public function setManufacturereIdList($manufacturereIdList)
    {
        $this->manufacturereIdList = $manufacturereIdList;
    }

    /**
     * @return ArrayCollection
     */
    public function getManufacturers()
    {
        return $this->manufacturers;
    }

    /**
     * @param ArrayCollection $manufacturers
     *
     * @return ProductData
     */
    public function setManufacturers($manufacturers)
    {
        $this->manufacturers = $manufacturers;
    }

    /**
     * @return integer
     */
    public function getMaxBuyAmount()
    {
        return $this->maxBuyAmount;
    }

    /**
     * @param int $maxBuyAmount
     *
     * @return ProductData
     */
    public function setMaxBuyAmount($maxBuyAmount)
    {
        $this->maxBuyAmount = $maxBuyAmount;
    }

    /**
     * @return ArrayCollection
     */
    public function getMedia()
    {
        return $this->media;
    }

    /**
     * @param ArrayCollection $media
     *
     * @return ProductData
     */
    public function setMedia($media)
    {
        $this->media = $media;
    }

    /**
     * @return integer
     */
    public function getMinBuyAmount()
    {
        return $this->minBuyAmount;
    }

    /**
     * @param int $minBuyAmount
     *
     * @return ProductData
     */
    public function setMinBuyAmount($minBuyAmount)
    {
        $this->minBuyAmount = $minBuyAmount;
    }

    /**
     * @return integer
     */
    public function getMinBuyAmountB2B()
    {
        return $this->minBuyAmountB2B;
    }

    /**
     * @param int $minBuyAmountB2B
     *
     * @return ProductData
     */
    public function setMinBuyAmountB2B($minBuyAmountB2B)
    {
        $this->minBuyAmountB2B = $minBuyAmountB2B;
    }

    /**
     * @return string
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * @param string $number
     *
     * @return ProductData
     */
    public function setNumber($number)
    {
        $this->number = $number;
    }

    /**
     * @return string
     */
    public function getPicture()
    {
        return $this->picture;
    }

    /**
     * @param string $picture
     *
     * @return ProductData
     */
    public function setPicture($picture)
    {
        $this->picture = $picture;
    }

    /**
     * @return ArrayCollection
     */
    public function getPrices()
    {
        return $this->prices;
    }

    /**
     * @param ArrayCollection $prices
     *
     * @return ProductData
     */
    public function setPrices($prices)
    {
        $this->prices = $prices;
    }

    /**
     * @return ArrayCollection
     */
    public function getProductCategories()
    {
        return $this->productCategories;
    }

    /**
     * @param ArrayCollection $productCategories
     *
     * @return ProductData
     */
    public function setProductCategories($productCategories)
    {
        $this->productCategories = $productCategories;
    }

    /**
     * @return ArrayCollection
     */
    public function getProductRelations()
    {
        return $this->productRelations;
    }

    /**
     * @param ArrayCollection $productRelations
     *
     * @return ProductData
     */
    public function setProductRelations($productRelations)
    {
        $this->productRelations = $productRelations;
    }

    /**
     * @return object
     */
    public function getProductType()
    {
        return $this->productType;
    }

    /**
     * @param object $productType
     *
     * @return ProductData
     */
    public function setProductType($productType)
    {
        $this->productType = $productType;
    }

    /**
     * @return integer
     */
    public function getSalesCount()
    {
        return $this->salesCount;
    }

    /**
     * @param int $salesCount
     *
     * @return ProductData
     */
    public function setSalesCount($salesCount)
    {
        $this->salesCount = $salesCount;
    }

    /**
     * @return ArrayCollection
     */
    public function getSegmentIdList()
    {
        return $this->segmentIdList;
    }

    /**
     * @param ArrayCollection $segmentIdList
     *
     * @return ProductData
     */
    public function setSegmentIdList($segmentIdList)
    {
        $this->segmentIdList = $segmentIdList;
    }

    /**
     * @return ArrayCollection
     */
    public function getSegments()
    {
        return $this->segments;
    }

    /**
     * @param ArrayCollection $segments
     *
     * @return ProductData
     */
    public function setSegments($segments)
    {
        $this->segments = $segments;
    }

    /**
     * @return ArrayCollection
     */
    public function getSiteSettings()
    {
        return $this->siteSettings;
    }

    /**
     * @param ArrayCollection $siteSettings
     *
     * @return ProductData
     */
    public function setSiteSettings($siteSettings)
    {
        $this->siteSettings = $siteSettings;
    }

    /**
     * @return integer
     */
    public function getSortOrder()
    {
        return $this->sortOrder;
    }

    /**
     * @param int $sortOrder
     *
     * @return ProductData
     */
    public function setSortOrder($sortOrder)
    {
        $this->sortOrder = $sortOrder;
    }

    /**
     * @return integer
     */
    public function getStockCount()
    {
        return $this->stockCount;
    }

    /**
     * @param int $stockCount
     *
     * @return ProductData
     */
    public function setStockCount($stockCount)
    {
        $this->stockCount = $stockCount;
    }

    /**
     * @return integer
     */
    public function getStockLimit()
    {
        return $this->stockLimit;
    }

    /**
     * @param int $stockLimit
     *
     * @return ProductData
     */
    public function setStockLimit($stockLimit)
    {
        $this->stockLimit = $stockLimit;
    }

    /**
     * @return integer
     */
    public function getTypeId()
    {
        return $this->typeId;
    }

    /**
     * @param int $typeId
     *
     * @return ProductData
     */
    public function setTypeId($typeId)
    {
        $this->typeId = $typeId;
    }

    /**
     * @return string
     */
    public function getUpdated()
    {
        return $this->updated;
    }

    /**
     * @param string $updated
     *
     * @return ProductData
     */
    public function setUpdated($updated)
    {
        $this->updated = $updated;
    }

    /**
     * @return string
     */
    public function getUpdatedBy()
    {
        return $this->updatedBy;
    }

    /**
     * @param string $updatedBy
     *
     * @return ProductData
     */
    public function setUpdatedBy($updatedBy)
    {
        $this->updatedBy = $updatedBy;
    }

    /**
     * @return ArrayCollection
     */
    public function getVariantGroupIdList()
    {
        return $this->variantGroupIdList;
    }

    /**
     * @param ArrayCollection $variantGroupIdList
     *
     * @return ProductData
     */
    public function setVariantGroupIdList($variantGroupIdList)
    {
        $this->variantGroupIdList = $variantGroupIdList;
    }

    /**
     * @return ArrayCollection
     */
    public function getVariantGroups()
    {
        return $this->variantGroups;
    }

    /**
     * @param ArrayCollection $variantGroups
     *
     * @return ProductData
     */
    public function setVariantGroups($variantGroups)
    {
        $this->variantGroups = $variantGroups;
    }

    /**
     * @return ArrayCollection
     */
    public function getVariantIdList()
    {
        return $this->variantIdList;
    }

    /**
     * @param ArrayCollection $variantIdList
     *
     * @return ProductData
     */
    public function setVariantIdList($variantIdList)
    {
        $this->variantIdList = $variantIdList;
    }

    /**
     * @return string
     */
    public function getVariantMasterId()
    {
        return $this->variantMasterId;
    }

    /**
     * @param string $variantMasterId
     *
     * @return ProductData
     */
    public function setVariantMasterId($variantMasterId)
    {
        $this->variantMasterId = $variantMasterId;
    }

    /**
     * @return ArrayCollection
     */
    public function getVariants()
    {
        return $this->variants;
    }

    /**
     * @param ArrayCollection $variants
     *
     * @return ProductData
     */
    public function setVariants($variants)
    {
        $this->variants = $variants;
    }

    /**
     * @return string
     */
    public function getVendorNumber()
    {
        return $this->vendorNumber;
    }

    /**
     * @param string $vendorNumber
     *
     * @return ProductData
     */
    public function setVendorNumber($vendorNumber)
    {
        $this->vendorNumber = $vendorNumber;
    }

    /**
     * @return double
     */
    public function getWeight()
    {
        return $this->weight;
    }

    /**
     * @param double $weight
     *
     * @return ProductData
     */
    public function setWeight($weight)
    {
        $this->weight = $weight;
    }
}
