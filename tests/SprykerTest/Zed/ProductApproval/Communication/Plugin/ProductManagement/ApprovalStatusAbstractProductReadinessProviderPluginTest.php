<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

 namespace SprykerTest\Zed\ProductApproval\Communication\Plugin\ProductManagement;

use ArrayObject;
use Codeception\Test\Unit;
use Generated\Shared\Transfer\ProductAbstractReadinessRequestTransfer;
use Generated\Shared\Transfer\ProductAbstractTransfer;
use Spryker\Zed\ProductApproval\Communication\Plugin\ProductManagement\ApprovalStatusAbstractProductReadinessProviderPlugin;

/**
 * Auto-generated group annotations
 *
 * @group SprykerTest
 * @group Zed
 * @group ProductApproval
 * @group Communication
 * @group Plugin
 * @group ProductManagement
 * @group ApprovalStatusAbstractProductReadinessProviderPluginTest
 * Add your own group annotations below this line
 */
class ApprovalStatusAbstractProductReadinessProviderPluginTest extends Unit
{
    /**
     * @return void
     */
    public function testProvideAddsApprovalStatusReadiness(): void
    {
        // Arrange
        $productAbstractTransfer = (new ProductAbstractTransfer())
            ->setApprovalStatus('approved');

        $productAbstractReadinessRequestTransfer = (new ProductAbstractReadinessRequestTransfer())
            ->setProductAbstract($productAbstractTransfer);

        // Act
        $result = (new ApprovalStatusAbstractProductReadinessProviderPlugin())->provide(
            $productAbstractReadinessRequestTransfer,
            new ArrayObject(),
        );

        // Assert
        $this->assertCount(1, $result->getArrayCopy());
        $productReadiness = $result->getArrayCopy()[0];
        $this->assertSame('Approval Status', $productReadiness->getTitle());
        $this->assertCount(1, $productReadiness->getValues());
        $this->assertSame('approved', $productReadiness->getValues()[0]);
    }
}
