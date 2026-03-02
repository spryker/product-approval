<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\ProductApproval\Business\Expander;

use Generated\Shared\Transfer\ProductAbstractTransfer;
use Spryker\Zed\ProductApproval\ProductApprovalConfig;

class ProductAbstractExpander implements ProductAbstractExpanderInterface
{
    /**
     * @var \Spryker\Zed\ProductApproval\ProductApprovalConfig
     */
    protected $productApprovalConfig;

    public function __construct(ProductApprovalConfig $productApprovalConfig)
    {
        $this->productApprovalConfig = $productApprovalConfig;
    }

    public function expandProductAbstract(ProductAbstractTransfer $productAbstractTransfer): ProductAbstractTransfer
    {
        if ($productAbstractTransfer->getApprovalStatus()) {
            return $productAbstractTransfer;
        }

        $productAbstractTransfer->setApprovalStatus($this->productApprovalConfig->getDefaultProductApprovalStatus());

        return $productAbstractTransfer;
    }
}
