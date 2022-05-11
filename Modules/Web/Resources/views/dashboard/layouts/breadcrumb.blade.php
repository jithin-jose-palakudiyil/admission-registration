<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-right">
                <?php if(isset($breadcrumb) && !empty($breadcrumb)):  ?>  
                <ol class="breadcrumb m-0">
                    <?php foreach ($breadcrumb as $key => $value): 
                        if(isset($value['active'])): ?>
                            <li class="breadcrumb-item active"> {{$value['title']}}</li>
                            
                        <?php else: ?>
                            <li class="breadcrumb-item"><a href="{{$value['url']}}">{{$value['title']}}</a></li>
                        <?php endif; ?> 
                    <?php   endforeach;  ?>
                </ol>
                <?php endif;  ?>
                <?php   ?>
                 <?php  if(isset($CreateBtn['btn_txt']) && isset($CreateBtn['url'])):  ?>
                    
                    <div class="row">
                        <div class="col-md-12">
                            <a href="{{$CreateBtn['url']}}">
                                <button type="button" style="  float: right;  margin-bottom: 15px; " class="btn btn-primary waves-effect waves-light">
                                    <i class="bx bx-smile label-icon"></i> {{$CreateBtn['btn_txt']}}
                                </button>
                            </a>
                       </div>
                   </div>
                    <?php endif; ?>
            </div>
            <h4 class="page-title"><?php  if (isset($breadcrumb_title)){ echo $breadcrumb_title; } ?></h4>
        </div>
    </div>
</div> 
