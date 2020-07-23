<?php
/**
 * Preference class file
 */
namespace MercadoPago;

use MercadoPago\Annotation\RestMethod;
use MercadoPago\Annotation\RequestParam;
use MercadoPago\Annotation\Attribute;

/**
 * Preference class
 * @RestMethod(resource="/checkout/preferences", method="create")
 * @RestMethod(resource="/checkout/preferences/:id", method="read")
 * @RestMethod(resource="/checkout/preferences/:id", method="update")
 * @RequestParam(param="access_token") 
 */
class Preference extends Entity
{
    /**
     * id
     * @Attribute(primaryKey = true, type = "string", readOnly = true)
     * @var string
     */
    protected $id;

    /**
     * auto_return
     * @Attribute()
     * @var string
     */
    protected $auto_return;

    /**
     * back_urls
     * @Attribute()
     * @var object
     */
    protected $back_urls;

    /**
     * notification_url
     * @Attribute(type = "string", maxLength = 500)
     * @var string
     */
    protected $notification_url;

    /**
     * init_point
     * @Attribute(type = "string", readOnly = true)
     * @var string
     */
    protected $init_point;

    /**
     * sandbox_init_point
     * @Attribute(type = "string", readOnly = true)
     * @var string
     */
    protected $sandbox_init_point;

    /**
     * operation_type
     * @Attribute(type = "string", readOnly = true)
     * @var string
     */
    protected $operation_type;

    /**
     * additional_info
     * @Attribute(type = "string", maxLength = 600)
     * @var string
     */
    protected $additional_info;

    /**
     * external_reference
     * @Attribute(type = "string", maxLength = 256)
     * @var string
     */
    protected $external_reference;

    /**
     * expires
     * @Attribute()
     * @var boolean
     */
    protected $expires;

    /**
     * expiration_date_from
     * @Attribute(type = "date")
     * @var \DateTime
     */
    protected $expiration_date_from;

    /**
     * expiration_date_to
     * @Attribute(type = "date")
     * @var \DateTime
     */
    protected $expiration_date_to;

    /**
     * collector_id
     * @Attribute(type = "int", readOnly = true)
     * @var int
     */
    protected $collector_id;

    /**
     * client_id
     * @Attribute(type = "int", readOnly = true)
     * @var int
     */
    protected $client_id;

    /**
     * marktplace
     * @Attribute(type = "string")
     * @var string
     */
    protected $marketplace;

    /**
     * marketplace_fee
     * @Attribute(type = "float")
     * @var float
     */
    protected $marketplace_fee;

    /**
     * differential_pricing
     * @Attribute()
     * @var object
     */
    protected $differential_pricing;

    /**
     * payment_methods
     * @Attribute()
     * @var object
     */
    protected $payment_methods;

    /**
     * items
     * @Attribute(type = "array", required = "true")
     * @var array
     */
    protected $items;

    /**
     * payer
     * @Attribute(type = "object")
     * @var object
     */
    protected $payer;

    /**
     * shipments
     * @Attribute(type = "object")
     * @var object
     */
    protected $shipments;

    /**
     * date_created
     * @Attribute(type = "date")
     * @var \DateTime
     */
    protected $date_created;

    /**
     * sponsor_id
     * @Attribute(type = "integer")
     * @var int
     */
    protected $sponsor_id;

    /**
     * processing_modes
     * @Attribute(type = "array")
     * @var array
     */
    protected $processing_modes;

    /**
     * binary_mode
     * @Attribute()
     * @var boolean
     */
    protected $binary_mode;

    /**
     * taxes
     * @Attribute(type = "array")
     * @var array
     */
    protected $taxes;

    /**
     * metadata
     * @Attribute()
     * @var object
     */
    protected $metadata;

    /**
     * tracks
     * @Attribute(type = "array")
     * @var array
     */
    protected $tracks;

}
