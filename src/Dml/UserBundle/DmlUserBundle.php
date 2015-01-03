<?php

namespace Dml\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class DmlUserBundle extends Bundle
{
	public function getParent()
	{
		return 'FOSUserBundle';
	}
}