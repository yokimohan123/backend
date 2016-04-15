<h3 class="box-title">Update Position</h3>

        <div class="box-body">            
            <div class="form-group" name="position_id">
                <select   class="form-control selec-box">                    
                    <option></option>                                  
                    <option>Product Images</option>  
                    <option>Product Attachments</option>
                    @if($line['parent_category_id'] == 1 || $line['parent_category_id'] == 70  )
                    <option>Product LineDrawings</option>
                    @endif
                </select>            
                    <div  id="drag-drop">
                                <?php if($product['product_images']!=''){?> 
                                       {{ Form::open( ['route' => ['backend.products.image.position'], 'method' => 'post']) }}
                                                                    <a class="selimg" href='#'>
                                                                        <ul id="current-files" name="position_id">
                                                                            <?php foreach($product['product_images'] as $prods){?>                                                                       
                                                                                <li id="listOrder_{{$prods['id']}}">
                                                                                    <img src="{{URL::to('/')}}/uploads/products/small/{{$prods['product_id']}}/{{$prods['image_path']}}">
                                                                                </li>                                                                                                                                            
                                                                            <?php }?>
                                                                        </ul>
                                                                    </a>
                                       {{ Form::close() }}
                                <?php }?>      
                    </div>

                    <div id="line-position">
                                <?php if($product['product_line_drawings']!=''){?>
                                       {{ Form::open( ['route' => ['backend.products.line.position'], 'method' => 'post']) }}
                                                                    <a class= "selline" href='#'>
                                                                        <ul id="rfiles" name="position_id">
                                                                            <?php foreach($product['product_line_drawings'] as $prodssss){?>
                                                                              <li id="listLine_{{$prodssss['id']}}">
                                                                                  <img src="{{URL::to('/')}}/uploads/line-drawings/{{$prodssss['product_id']}}/{{$prodssss['image_path']}}" height="200px" width="200px" name="position">
                                                                              </li>
                                                                            <?php }?>
                                                                        </ul>
                                                                    </a>
                                       {{ Form::close() }} 
                                <?php }?>                               
                    </div>       


                    <div id="pdf-position">
                                <?php if($product['product_attachments']!=''){?>    
                                       {{ Form::open( ['route' => ['backend.products.pdf.position'], 'method' => 'post']) }}
                                                            <ul class="selatt" name="position_id">
                                                                <?php foreach($product['product_attachments'] as $prosde){?>   
                                                                <li id="listPdf_{{$prosde['id']}}">  
                                                                    <img src="{{URL::to('/')}}/template/default/images/pdf-icon.png" title="{{$prosde['title']}}" class="jk" style="text-align: center;">
                                                                    <a href="{{URL::to('/')}}/uploads/attachments/{{$prosde['product_id']}}/{{$prosde['file_path']}}" target="_blank" class="jk" style="width: 100%;text-align: center;">{{$prosde['file_path']}}</a>                                                           
                                                                </li>
                                                                <?php }?>
                                                             </ul>
                                        {{ Form::close() }}
                                <?php }?>
                    </div>
            </div>					                                             
        </div>




