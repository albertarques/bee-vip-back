<?php

namespace App\Permissions;

class Permission
{

  // Users Permissions =====================================================
    // User, Admin, Superadmin
    public const CAN_UPDATE_MY_USER_PROFILE = "user-update-my-profile";
    public const CAN_DELETE_MY_USER_PROFILE = "user-delete-my-profile";

    // Superadmin
    public const CAN_DELETE_USER = "user-delete";
    public const CAN_UPDATE_USER_ROLE = "user-role-update";


  // Payment Methods Permissions ===========================================
  public const CAN_CREATE_PAYMENT_METHOD = "payment-method-create";
  public const CAN_DELETE_PAYMENT_METHOD = "payment-method-delete";
  public const CAN_VIEW_PAYMENT_METHOD = "payment-method-show";
  public const CAN_UPDATE_PAYMENT_METHOD = "payment-method-update";

  // Orders Permissions ====================================================
  public const CAN_CREATE_ORDER = "order-create";
  public const CAN_VIEW_ORDER = "order-show";
  public const CAN_UPDATE_ORDER = "order-update";
  public const CAN_DELETE_ORDER = "order-delete";

  // Order details =========================================================
  public const CAN_CREATE_ORDER_DETAIL = "order-detail-create";

  // Entrepreneurships Permissions =========================================
    // Admin user
      public const CAN_CREATE_ENTREPRENEURSHIP = "entrepreneurship-create";
      public const CAN_DELETE_MY_ENTREPRENEURSHIP = "entrepreneurship-delete-my";
      public const CAN_UPDATE_MY_ENTREPRENEURSHIP = "entrepreneurship-update-my";
      public const CAN_VIEW_MY_ENTREPRENEURSHIPS = "entrepreneurships-view-my";

    // Superadmin user
      public const CAN_DELETE_ENTREPRENEURSHIP = "entrepreneurship-delete";
      public const CAN_INSPECT_ENTREPRENEURSHIP = "entrepreneurship-inspect";
      public const CAN_VIEW_PENDING_ENTREPRENEURSHIPS = "entrepreneurships-view-pending";

  // Comments Permissions =================================
    // Users
    public const CAN_CREATE_COMMENT = "comment-create";
    public const CAN_UPDATE_MY_COMMENT = "comment-update-my";
    public const CAN_DELETE_MY_COMMENT = "comment-delete-my";

    // Superadmin
      public const CAN_DELETE_COMMENT = "comment-delete";

  // Categories Permissions ================================================
  public const CAN_CREATE_CATEGORY = "category-create";
  public const CAN_UPDATE_CATEGORY = "category-update";
  public const CAN_DELETE_CATEGORY = "category-delete";
}
