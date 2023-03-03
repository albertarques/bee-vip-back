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
    // ¿? public const CAN_UPDATE_ORDER = "update-order";
    // ¿? public const CAN_DELETE_ORDER = "delete-order";

    // Order details
    public const CAN_CREATE_ORDER_DETAIL = "create-order-detail";
    public const CAN_VIEW_ORDER_DETAIL = "view-order-detail";
    // ¿? public const CAN_UPDATE_ORDER_DETAIL = "update-order-detail";
    // ¿? public const CAN_DELETE_ORDER_DETAIL = "delete-order-detail";

    // Comment Entrepreneurships
    public const CAN_CREATE_COMMENT = "create-comment";
    // ¿? public const CAN_VIEW_COMMENT = "view-comment";
    // TODO: public const CAN_UPDATE_COMMENT = "update-comment";
    // TODO: public const CAN_DELETE_COMMENT = "delete-comment";

    // *************** Admin Permissions ************************************
    // User Profile
    // public const CAN_VIEW_USERPROFILE = "view-user-profile";

    // Entrepreneurships
    public const CAN_CREATE_ENTREPRENEURSHIP = "create-entrepreneurship";
    public const CAN_UPDATE_ENTREPRENEURSHIP = "update-entrepreneurship";
    public const CAN_DELETE_ENTREPRENEURSHIP = "delete-entrepreneurship";
    public const CAN_VIEW_PENDING_ENTREPRENEURSHIPS = "view-pending-entrepreneurships";
    public const CAN_VIEW_ENTREPRENEURSHIPS = "view-entrepreneurships";

    // *************** Superadmin Permissions ************************************
    //Roles
    public const CAN_APPROVE_USERTOADMIN = "approve-user-to-admin";
    public const CAN_APPROVE_ADMINTOSUPERADMIN = "approve-admin-to-superadmin";
    public const CAN_DELETE_USER = "delete-user";


    // Entrepreneurships
    public const CAN_APPROVE_ENTREPRENEURSHIPS = "approve-entrepreneurship";
}
