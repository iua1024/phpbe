<?php
namespace ui\tinymce;

class tinymce extends \system\ui
{

    protected $name = ''; // 名称
    protected $value = ''; // 默认值
    protected $width = '100%'; // 宽度
    protected $height = '200px'; // 高度


    public function init()
    {
        $this->name = '';
        $this->value = '';
        $this->width = '100%';
        $this->height = '200px';
    }
    
    public function setName($name)
    {
        $this->name = $name;
    }
    
    public function setValue($value)
    {
        $this->value = $value;
    }
    
    public function setWidth($width)
    {
        $this->width = $width;
    }
    
    public function setHeight($height)
    {
        $this->height = $height;
    }
    
    public function setSize($width, $height)
    {
        $this->width = $width;
        $this->height = $height;
    }


	protected $head = false;
	public function head()
	{
		if (!$this->head) {
			$this->head = true;
?>
<script type="text/javascript" src="<?php echo Be::getRuntime()->getUrlRoot(); ?>/ui/tinymce/4.1.5/jquery.tinymce.min.js"></script>

<script type="text/javascript">
	$().ready(function() {
		$('textarea.tinymce').tinymce({
			scriptUrl : '<?php echo Be::getRuntime()->getUrlRoot(); ?>/ui/tinymce/4.1.5/tinymce.min.js',
			language : "zh_CN",
            forcedRootBlock : false,
            forcePNewlines : false,
			plugins : 'advlist link charmap preview code image table',

			toolbar1: "styleselect bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | preview code",
			
			// 插入内容时跟据当前路径转换链接的路径。
			convertUrls: false
		});

	});
</script>
<?php
		}
	}

    public function display()
    {
        $this->head();
        echo '<textarea name="' . $this->name . '" id="' . $this->name . '" class="tinymce" style="width:' . $this->width . ';height:' . $this->height . ';">' . htmlspecialchars($this->value) . '</textarea>';
    }

}
