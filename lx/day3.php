<?php 
class Db{
       
      public static function fbnc($n){
       
         $i=1; $j=1;$sum=0;

           for( $k=0;$k<$n;$k++){
                   $j=$j+$i;
               
                   $i=$j-$i;//输出斐波那契数列的第n项
          
                  // $sum=$sum+$i;//求总和
           }
           
       return $i;

		}




		public static function dg($n){

			if($n==0||$n==1){
				return 1;die;
			}else{

			 return self::dg($n - 1) + self::dg($n - 2); 
			}
		}
	     
	
}


?>