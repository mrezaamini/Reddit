<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Foundation\Http\Middleware\TransformsRequest;

class ConvertNumberToEnglish extends TransformsRequest
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
	public function handle($request, Closure $next)
	{
		return parent::handle($request, $next);
	}

    public function transform($key,$value)
	{
		return $this->convert($value);
	}

	private function convert($string)
	{
		$newNumbers=range(0,9);
		// 1. Persian HTML decimal
		$persianDecimal=array('&#1776;','&#1777;','&#1778;','&#1779;','&#1780;','&#1781;','&#1782;','&#1783;','&#1784;','&#1785;');
		// 2. Arabic HTML decimal
		$arabicDecimal=array('&#1632;','&#1633;','&#1634;','&#1635;','&#1636;','&#1637;','&#1638;','&#1639;','&#1640;','&#1641;');
		// 3. Arabic Numeric
		$arabic=array('٠','١','٢','٣','٤','٥','٦','٧','٨','٩');
		// 4. Persian Numeric
		$persian=array('۰','۱','۲','۳','۴','۵','۶','۷','۸','۹');

		$string=str_replace($persianDecimal,$newNumbers,$string);
		$string=str_replace($arabicDecimal,$newNumbers,$string);
		$string=str_replace($arabic,$newNumbers,$string);
		return str_replace($persian,$newNumbers,$string);
	}
}
