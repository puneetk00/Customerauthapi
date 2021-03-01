<?php
namespace Jaybro\Customerauthapi\Model;
use Jaybro\Customerauthapi\Api\CustomerRepositoryInterface;
use Magento\Customer\Model\CustomerFactory;
use Magento\Framework\App\Http\Context;
use Magento\Customer\Api\CustomerRepositoryInterface as CutomerRepInterface;

class CustomerRepository implements CustomerRepositoryInterface
{

    private $_cusomerFactory;
    private $_context;
    private $_customerRepository;
    protected $userContext;
    
	
	public function __construct(
	CustomerFactory $CustomerFactory,Context $Context, 
	CutomerRepInterface $CustomerRepositoryInterface,
	\Magento\Authorization\Model\CompositeUserContext $userContext)
    {
		 $this->userContext = $userContext;
        $this->_customerFactory = $CustomerFactory;
        $this->_context = $Context;
        $this->_customerRepository = $CustomerRepositoryInterface;
    	

    }
	
	/**
     * 
     * @return int
     */
    public function getCustomerId()
    {
        return $customerId = $this->userContext->getUserId();
    }

    public function getCustomerInfo()
    {
		
           $customerId = $this->getCustomerId();
		   $customer = $this->_customerFactory->create()->load($customerId);
           $customerinfo = $this->_customerRepository->get($customer->getEmail());
           $cusomeruid =  $customerinfo->getCustomAttribute('p21customerid')->getValue();
         

       //   return json_encode($customer_Data) ;
         

        $customerAddressData = [];
        $customerAddress = [];
 
        if ($customer->getAddresses() != null)
        {
            foreach ($customer->getAddresses() as $address) {
                $customerAddress[] = $address->toArray();
            }
        }
 
        if ($customerAddress != null)
        {
            foreach ($customerAddress as $customerAddres)
            {
                $companyname = $customerAddres['company'];
                $street = $customerAddres['street'];
                $city = $customerAddres['city'];
                $region = $customerAddres['region'];
                $country = $customerAddres['country_id'];
                $postcode = $customerAddres['postcode'];
                $telephone = $customerAddres['telephone'];
               // $cutomer_pid = $customerAddres['p21contactid'];
 
               // $customerAddressData[] = $customerAddres->toArray();
               $customerAddressData = array("Street" => $street, "City" => $city,"Region" => $region,"Country" => $country,"Postcode" => $postcode,);


            }
        }
    // return $customerAddressData;

    $customer_Data = array("First Name" => $customer->getData('firstname'), "Last Name" =>  $customer->getData('lastname'), "Email Address" => $customer->getEmail() , "Phone Number" => $telephone, "Delivery address" => $customerAddressData,"Company Name" => $companyname,"Customer Unique ID" => $cusomeruid);
      return json_encode($customer_Data) ;

          

      
    }
}


?>