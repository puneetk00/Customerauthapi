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

    public function __construct(CustomerFactory $CustomerFactory,Context $Context, CutomerRepInterface $CustomerRepositoryInterface)
    {
        $this->_customerFactory = $CustomerFactory;
        $this->_context = $Context;
        $this->_customerRepository = $CustomerRepositoryInterface;
    	

    }

    public function getCustomerInfo($email)
    {
      /*  $userData = array("username" => $username, "password" => $password);
        $ch = curl_init("http://40.121.65.234:92/rest/V1/integration/customer/token");
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($userData));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json", "Content-Lenght: " . strlen(json_encode($userData))));
    
        $token = curl_exec($ch); 
        
    
       $ch = curl_init("http://40.121.65.234:92/rest/V2/jaybro_customerauthapi/". $username . "/". $password);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($userData));
        curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json", "Authorization: Bearer " . json_decode($token)));
    
        $result = curl_exec($ch); 
        var_dump($result->geId);

        

         */
           $websiteId = 1;
           $customerinfo = $this->_customerRepository->get($email,$websiteId);
       

           $customerId = $customerinfo->getId();



          $customer = $this->_customerFactory->create()->load($customerId);
         

          return json_encode($customer->getData()) ;
         

          

      
    }
}


?>