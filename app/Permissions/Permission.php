<?php

namespace App\Permissions;

class Permission {

    // ************** Users Permissions ************************************
    // User Profile
    public const CAN_UPDATE_USERPROFILE = "update-user-profile";
    public const CAN_DELETE_USERPROFILE = "delete-user-profile";


    // Payment Methods
    public const CAN_CREATE_PAYMENTMETHOD = "create-payment-method";
    public const CAN_VIEW_PAYMENTMETHOD = "view-payment-method";
    public const CAN_UPDATE_PAYMENTMETHOD = "update-payment-method";
    public const CAN_DELETE_PAYMENTMETHOD = "delete-payment-method";

    // Orders
    public const CAN_CREATE_ORDER = "create-order";
    public const CAN_VIEW_ORDER = "view-order";

    // Order details
    public const CAN_CREATE_ORDER_DETAIL = "create-order-detail";
    public const CAN_VIEW_ORDER_DETAIL = "view-order-detail";

    // Comment Entrepreneurships
    public const CAN_CREATE_COMMENT = "create-comment";

    // *************** Admin Permissions ************************************
    // Entrepreneurships
    public const CAN_CREATE_ENTREPRENEURSHIP = "create-entrepreneurship";
    public const CAN_UPDATE_ENTREPRENEURSHIP = "update-entrepreneurship";
    public const CAN_DELETE_ENTREPRENEURSHIP = "delete-entrepreneurship";
    public const CAN_VIEW_PENDING_ENTREPRENEURSHIPS = "view-pending-entrepreneurships";
    public const CAN_VIEW_ENTREPRENEURSHIPS = "view-entrepreneurships";

    // *************** Superadmin Permissions ********************************
    // Users
    public const CAN_DELETE_USER = "delete-user";
    public const CAN_UPDATE_USER_ROLE = "update-user-role";

    // Roles
    public const CAN_SHOW_USER_ROLE = "show-user-role";

    // Entrepreneurships
    public const CAN_APPROVE_ENTREPRENEURSHIPS = "approve-entrepreneurship";
}
