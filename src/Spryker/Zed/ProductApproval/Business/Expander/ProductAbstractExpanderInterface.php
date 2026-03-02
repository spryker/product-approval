<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\ProductApproval\Business\Expander;

use Generated\Shared\Transfer\ProductAbstractTransfer;

interface ProductAbstractExpanderInterface
{
    public function expandProductAbstract(ProductAbstractTransfer $productAbstractTransfer): ProductAbstractTransfer;
}
