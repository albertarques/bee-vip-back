<?php

namespace App\Permissions;

class Permission
{

  // Users Permissions =====================================================
  // User, Admin, Superadmin
  public const CAN_UPDATE_MY_USER_PROFILE = "update-my-profile";
  public const CAN_DELETE_MY_USER_PROFILE = "delete-my-profile";

  // Superadmin
  public const CAN_DELETE_USER = "delete-user";
  public const CAN_UPDATE_USER_ROLE = "update-user-role";


  // Payment Methods Permissions ===========================================
  public const CAN_CREATE_PAYMENT_METHOD = "create-payment-method";
  public const CAN_DELETE_PAYMENT_METHOD = "delete-payment-method";
  public const CAN_VIEW_PAYMENT_METHOD = "show-payment-method";
  public const CAN_UPDATE_PAYMENT_METHOD = "update-payment-method";

  // Orders Permissions ====================================================
  public const CAN_CREATE_ORDER = "create-order";
  public const CAN_VIEW_ORDER = "show-order";
  public const CAN_UPDATE_ORDER = "update-order";
  public const CAN_DELETE_ORDER = "delete-order";

  // Order details =========================================================
  public const CAN_CREATE_ORDER_DETAIL = "create-order-detail";

  // Entrepreneurships Permissions =========================================
  // Admin user
  public const CAN_CREATE_ENTREPRENEURSHIP = "create-entrepreneurship";
  public const CAN_DELETE_MY_ENTREPRENEURSHIP = "delete-my-entrepreneurship";
  public const CAN_UPDATE_MY_ENTREPRENEURSHIP = "update-my-entrepreneurship";
  public const CAN_VIEW_MY_ENTREPRENEURSHIPS = "view-my-entrepreneurships";

  // Superadmin user
  public const CAN_DELETE_ENTREPRENEURSHIP = "delete-entrepreneurship";
  public const CAN_INSPECT_ENTREPRENEURSHIP = "inspect-entrepreneurship";
  public const CAN_VIEW_PENDING_ENTREPRENEURSHIPS = "view-pending-entrepreneurships";

  // Comments Permissions =================================
  // Users
  public const CAN_CREATE_COMMENT = "create-comment";
  public const CAN_UPDATE_MY_COMMENT = "update-my-comment";
  public const CAN_DELETE_MY_COMMENT = "delete-my-comment";

  // Superadmin
  public const CAN_DELETE_COMMENT = "delete-comment";

  // Categories Permissions ================================================
  public const CAN_CREATE_CATEGORY = "create";
  public const CAN_UPDATE_CATEGORY = "update";
  public const CAN_DELETE_CATEGORY = "delete";
}
