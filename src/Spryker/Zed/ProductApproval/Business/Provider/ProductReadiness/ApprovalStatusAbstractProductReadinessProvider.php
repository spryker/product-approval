<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\ProductApproval\Business\Provider\ProductReadiness;

use ArrayObject;
use Generated\Shared\Transfer\ProductAbstractReadinessRequestTransfer;
use Generated\Shared\Transfer\ProductReadinessTransfer;

class ApprovalStatusAbstractProductReadinessProvider implements ProductAbstractReadinessProviderInterface
{
    /**
     * @var string
     */
    protected const TITLE_APPROVAL_STATUS = 'Approval Status';

    /**
     * @var string
     */
    protected const VALUE_NOT_SET = 'Not set';

    /**
     * @param \Generated\Shared\Transfer\ProductAbstractReadinessRequestTransfer $productAbstractReadinessRequestTransfer
     * @param \ArrayObject<int, \Generated\Shared\Transfer\ProductReadinessTransfer> $productReadinessTransfers
     *
     * @return \ArrayObject<int, \Generated\Shared\Transfer\ProductReadinessTransfer>
     */
    public function provide(
        ProductAbstractReadinessRequestTransfer $productAbstractReadinessRequestTransfer,
        ArrayObject $productReadinessTransfers
    ): ArrayObject {
        if (!$productAbstractReadinessRequestTransfer->getProductAbstract()) {
            return $productReadinessTransfers;
        }

        $productReadinessTransfers->append(
            (new ProductReadinessTransfer())
                ->setTitle(static::TITLE_APPROVAL_STATUS)
                ->addValue($productAbstractReadinessRequestTransfer->getProductAbstract()->getApprovalStatus() ?: static::VALUE_NOT_SET),
        );

        return $productReadinessTransfers;
    }
}
