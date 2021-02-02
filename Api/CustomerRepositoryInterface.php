<?php
namespace Jaybro\Customerauthapi\Api;



interface CustomerRepositoryInterface
{
   

    /**
     * [getCustomerInfo description]
     * @param  string $username [description]
     * @param  string $password [description]
     *  @return mixed
     */
	public function getCustomerInfo($email);

	

}