<?php
class Shop_info {
    protected $ci;
    private $get_info;

    function __construct() {
        $this->ci =& get_instance();

        $this->get_info = $this->ci->db->get_where("shop_info",["id" => 1])->row();
    }

    function get_shop_name() {
        return $this->get_info->name;
    }
    function get_shop_address() {
        return $this->get_info->address;
    }
    function get_image()
    {
        return $this->get_info->image;
    }
    function get_image_url()
    {
        return $this->get_info->image != null | $this->get_info->image != '' ? base_url('uploads/images/' . $this->get_info->image) : '';
    }
}