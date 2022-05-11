<div class="row">
<div class="col-12">
<div class="page-title-box">
    <div class="page-title-right"> 
        <?php   
            if(isset($breadcrumb) && !empty($breadcrumb)):  
            ?>  <ol class="breadcrumb m-0">  <?php 
            foreach ($breadcrumb as $key => $value): 
                if(isset($value['active']) && $value['active']):
                ?>   <li class="breadcrumb-item active">{{$value['title']}}</li> <?php 
                else:
                ?>   <li class="breadcrumb-item"><a href="{{$value['url']}}"> {{$value['title']}}</a></li> <?php 
                endif;
            endforeach;
            ?>  </ol>  <?php  
            endif;
         ?> 
         <?php 
            if(isset($CreateBtn['btn_txt']) && isset($CreateBtn['url'])): 
        ?>
            <a href="{{$CreateBtn['url']}}"> 
                <button style=" margin-bottom: 15px; margin-top: -5px;float: right;" type="button" class="btn btn-primary waves-effect waves-light">
                    <span class="btn-label"><i class="mdi mdi-check-all"></i></span>{{$CreateBtn['btn_txt']}}
                </button> 
            </a>
        <?php
            endif;
        ?>
    </div>
    <h4 class="page-title"><?php  if (isset($page_title)){ echo $page_title; } ?></h4>
</div>
</div>
</div>  
