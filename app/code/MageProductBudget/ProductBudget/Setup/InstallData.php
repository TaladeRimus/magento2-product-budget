<?php
 
// app/code/[VendorName]/[ModuleName]/Setup/InstallData.php
 
namespace MageDirect\Test\Setup;
 
use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Eav\Setup\EavSetupFactory;
use Magento\Catalog\Model\Product;
use MageDirect\Test\Model\Product\Type\MdProductType;
 
class InstallData implements InstallDataInterface
{
 
   /**
    * @var EavSetupFactory
    */
   private $eavSetupFactory;
 
   /**
    * @param EavSetupFactory $eavSetupFactory
    */
   public function __construct(EavSetupFactory $eavSetupFactory)
   {
       $this->eavSetupFactory = $eavSetupFactory;
   }
 
   public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
   {
 
       /** @var EavSetup $eavSetup */
       $eavSetup = $this->eavSetupFactory->create(['setup' => $setup]);
 
       $attributes = [
           'cost',
           'price',
           'special_price',
           'special_from_date',
           'special_to_date',
           'weight',
           'tax_class_id'
       ];
 
       foreach ($attributes as $attributeCode) {
           $relatedProductTypes = explode(
                   ',', $eavSetup->getAttribute(Product::ENTITY, $attributeCode, 'apply_to')
           );
           if (!in_array(BudgetProductType::TYPE_CODE, $relatedProductTypes)) {
               $relatedProductTypes[] = BudgetProductType::TYPE_CODE;
               $eavSetup->updateAttribute(
                       Product::ENTITY, 
                       $attributeCode, 
                       'apply_to', 
                       implode(',', $relatedProductTypes)
               );
           }
       }
   }
}