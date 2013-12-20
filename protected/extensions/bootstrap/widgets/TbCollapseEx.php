<?php
/**
 * TbNavbar class file.
 * @author Christoffer Niska <ChristofferNiska@gmail.com>
 * @copyright Copyright &copy; Christoffer Niska 2011-
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
 * @package bootstrap.widgets
 * @since 0.9.7
 */

Yii::import('bootstrap.widgets.TbCollapse');

/**
 * Bootstrap navigation bar widget.
 */
class TbCollapseEx extends CWidget
{

	public $items = array();
	/**
	 * @var array the HTML attributes for the widget container.
	 */
	public $htmlOptions = array();

	/**
	 * Initializes the widget.
	 */
	public function init()
	{
		$classes = array('accordion');
		if (!empty($classes))
		{
			$classes = implode(' ', $classes);
			if (isset($this->htmlOptions['class']))
				$this->htmlOptions['class'] .= ' '.$classes;
			else
				$this->htmlOptions['class'] = $classes;
		}
	}
       
private  function get_height($item){
   static $height;
   if(isset($height))
    return "0px";      
  	foreach($item as $e){
  	if(is_array($e['items']))
    foreach($e['items'] as $s){
        if(isset($s['url'])){
           $url=$s['url']; 
           if(is_array($s['url']))
           $url=$s['url'][0];
           if(strpos($url,$_GET['r'])>0){
            $height='auto';
            return $height;
            }
       }
 }                      
}
return "0px";
}

   private  function render_item($item,$idx){
    $text='';
    echo '<div class="accordion-group">';
    echo '<div class="accordion-heading">';
    if(isset($item['title']))
    $text=$item['title'];
    if(isset($item['icon'])){
    $text='<i class ="icon-'.$item['icon'].'"></i>'." ".$text;
    }
    echo CHtml::link($text,"#collapse$idx", array('class'=>'accordion-toggle','data-toggle'=>'collapse','data-parent'=>"#".$this->getId()));
    echo "</div>";
    $in='';    
    $h=$this->get_height($item);
    if($h==='auto') $in="in";
    
    echo CHtml::openTag("div", array('id'=>"collapse$idx",'class'=>"accordion-body collapse $in",'style'=>"height:$h;"));
    echo '<div class="accordion-inner">';
    
    	if (is_string($item))
				echo $item;
			else
			{
			foreach($item as $e){
			 if (is_array($e)){
				if (isset($e['class']))
				{
					$className = $e['class'];
					unset($e['class']);
					$this->controller->widget($className, $e);
                    
				}
                }
			}
            }
       echo  "</div></div></div> ";    
   }       
            
	public function run()
	{
	   $id=$this->getId();
	   $this->htmlOptions['id']=$id;
       echo CHtml::openTag('div', $this->htmlOptions);
       foreach ($this->items as $id =>$item)
		{
		 $this->render_item($item,$id);
		}
		echo '</div>';
	}

	
}
