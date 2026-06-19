<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\ProductApproval\Business;

use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;
use Spryker\Zed\ProductApproval\Business\Expander\ProductAbstractExpander;
use Spryker\Zed\ProductApproval\Business\Expander\ProductAbstractExpanderInterface;
use Spryker\Zed\ProductApproval\Business\Extractor\QuoteOriginalSalesOrderItemExtractor;
use Spryker\Zed\ProductApproval\Business\Extractor\QuoteOriginalSalesOrderItemExtractorInterface;
use Spryker\Zed\ProductApproval\Business\Filter\ProductAbstractStorageCollectionFilter;
use Spryker\Zed\ProductApproval\Business\Filter\ProductAbstractStorageCollectionFilterInterface;
use Spryker\Zed\ProductApproval\Business\Filter\ProductConcreteCollectionFilter;
use Spryker\Zed\ProductApproval\Business\Filter\ProductConcreteCollectionFilterInterface;
use Spryker\Zed\ProductApproval\Business\Filter\ProductConcreteStorageCollectionFilter;
use Spryker\Zed\ProductApproval\Business\Filter\ProductConcreteStorageCollectionFilterInterface;
use Spryker\Zed\ProductApproval\Business\Filter\ProductPageSearchCollectionFilter;
use Spryker\Zed\ProductApproval\Business\Filter\ProductPageSearchCollectionFilterInterface;
use Spryker\Zed\ProductApproval\Business\Filter\QuoteItemsFilter;
use Spryker\Zed\ProductApproval\Business\Filter\QuoteItemsFilterInterface;
use Spryker\Zed\ProductApproval\Business\Provider\ProductReadiness\ApprovalStatusAbstractProductReadinessProvider;
use Spryker\Zed\ProductApproval\Business\Provider\ProductReadiness\ProductAbstractReadinessProviderInterface;
use Spryker\Zed\ProductApproval\Business\Reader\ApplicableApprovalStatusReader;
use Spryker\Zed\ProductApproval\Business\Reader\ApplicableApprovalStatusReaderInterface;
use Spryker\Zed\ProductApproval\Business\Reader\ProductReader;
use Spryker\Zed\ProductApproval\Business\Reader\ProductReaderInterface;
use Spryker\Zed\ProductApproval\Business\Validator\ProductApprovalCartChangeValidator;
use Spryker\Zed\ProductApproval\Business\Validator\ProductApprovalCartChangeValidatorInterface;
use Spryker\Zed\ProductApproval\Business\Validator\ProductApprovalCheckoutValidator;
use Spryker\Zed\ProductApproval\Business\Validator\ProductApprovalCheckoutValidatorInterface;
use Spryker\Zed\ProductApproval\Business\Validator\ProductApprovalShoppingListValidator;
use Spryker\Zed\ProductApproval\Business\Validator\ProductApprovalShoppingListValidatorInterface;
use Spryker\Zed\ProductApproval\Dependency\Facade\ProductApprovalToMessengerFacadeInterface;
use Spryker\Zed\ProductApproval\Dependency\Facade\ProductApprovalToProductFacadeInterface;
use Spryker\Zed\ProductApproval\ProductApprovalDependencyProvider;

/**
 * @method \Spryker\Zed\ProductApproval\ProductApprovalConfig getConfig()
 */
class ProductApprovalBusinessFactory extends AbstractBusinessFactory
{
    public function createApplicableApprovalStatusReader(): ApplicableApprovalStatusReaderInterface
    {
        return new ApplicableApprovalStatusReader($this->getConfig());
    }

    public function createProductAbstractStorageCollectionFilter(): ProductAbstractStorageCollectionFilterInterface
    {
        return new ProductAbstractStorageCollectionFilter($this->createProductReader());
    }

    public function createProductConcreteStorageCollectionFilter(): ProductConcreteStorageCollectionFilterInterface
    {
        return new ProductConcreteStorageCollectionFilter($this->getProductFacade());
    }

    public function createProductPageSearchCollectionFilter(): ProductPageSearchCollectionFilterInterface
    {
        return new ProductPageSearchCollectionFilter($this->createProductReader());
    }

    public function createProductConcreteCollectionFilter(): ProductConcreteCollectionFilterInterface
    {
        return new ProductConcreteCollectionFilter($this->getProductFacade());
    }

    public function createProductApprovalCartChangeValidator(): ProductApprovalCartChangeValidatorInterface
    {
        return new ProductApprovalCartChangeValidator($this->getProductFacade());
    }

    public function createQuoteOriginalSalesOrderItemExtractor(): QuoteOriginalSalesOrderItemExtractorInterface
    {
        return new QuoteOriginalSalesOrderItemExtractor();
    }

    public function createQuoteItemsFilter(): QuoteItemsFilterInterface
    {
        return new QuoteItemsFilter(
            $this->createProductReader(),
            $this->getMessengerFacade(),
        );
    }

    public function createProductApprovalCheckoutValidator(): ProductApprovalCheckoutValidatorInterface
    {
        return new ProductApprovalCheckoutValidator($this->createProductReader(), $this->getConfig());
    }

    public function createProductReader(): ProductReaderInterface
    {
        return new ProductReader($this->getProductFacade());
    }

    public function createProductAbstractExpander(): ProductAbstractExpanderInterface
    {
        return new ProductAbstractExpander($this->getConfig());
    }

    public function createProductApprovalShoppingListValidator(): ProductApprovalShoppingListValidatorInterface
    {
        return new ProductApprovalShoppingListValidator($this->getProductFacade());
    }

    public function createApprovalStatusAbstractProductReadinessProvider(): ProductAbstractReadinessProviderInterface
    {
        return new ApprovalStatusAbstractProductReadinessProvider();
    }

    public function getProductFacade(): ProductApprovalToProductFacadeInterface
    {
        return $this->getProvidedDependency(ProductApprovalDependencyProvider::FACADE_PRODUCT);
    }

    public function getMessengerFacade(): ProductApprovalToMessengerFacadeInterface
    {
        return $this->getProvidedDependency(ProductApprovalDependencyProvider::FACADE_MESSENGER);
    }
}
