<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\ProductApproval\Communication\Plugin\Checkout;

use Generated\Shared\Transfer\CheckoutResponseTransfer;
use Generated\Shared\Transfer\QuoteTransfer;
use Spryker\Zed\CheckoutExtension\Dependency\Plugin\CheckoutPreConditionPluginInterface;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

/**
 * @method \Spryker\Zed\ProductApproval\Business\ProductApprovalFacadeInterface getFacade()
 * @method \Spryker\Zed\ProductApproval\Business\ProductApprovalBusinessFactory getBusinessFactory()
 * @method \Spryker\Zed\ProductApproval\ProductApprovalConfig getConfig()
 */
class OrderAmendmentProductApprovalCheckoutPreConditionPlugin extends AbstractPlugin implements CheckoutPreConditionPluginInterface
{
    /**
     * {@inheritDoc}
     * - Requires `QuoteTransfer.originalSalesOrderItems.sku` to be set.
     * - Validates the items from `QuoteTransfer.items` and the product bundles from `QuoteTransfer.bundleItems`.
     * - Deduplicates `QuoteTransfer.bundleItems` by `QuoteTransfer.bundleItem.groupKey`, so a bundle added several times is validated once.
     * - Returns `false` response if at least one quote item transfer has items with not approved product.
     * - Sets error messages to checkout response, if a quote contains not approved product items.
     * - Skips validation for items that are part of the original order.
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     * @param \Generated\Shared\Transfer\CheckoutResponseTransfer $checkoutResponseTransfer
     *
     * @return bool
     */
    public function checkCondition(QuoteTransfer $quoteTransfer, CheckoutResponseTransfer $checkoutResponseTransfer): bool
    {
        $itemSkusToSkipValidation = $this->getBusinessFactory()
            ->createQuoteOriginalSalesOrderItemExtractor()
            ->extractOriginalSalesOrderItemSkus($quoteTransfer);

        return $this->getBusinessFactory()
            ->createProductApprovalCheckoutValidator()
            ->validateQuoteForCheckout($quoteTransfer, $checkoutResponseTransfer, $itemSkusToSkipValidation);
    }
}
