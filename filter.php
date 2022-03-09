<?php  include("../common/config.php"); 
extract($_POST);

   ?>
   <table id="example" class="display" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th></th>
                        <th >id</th>
                         <th>photo</th>
                         <th>product name</th>
                         <th>category</th>
                         <th>brand</th>
                         <th>price</th>
                         <th>weight</th>
                         <th>balance stock</th>
                         <th>status</th>
                         <th>Type</th>
                         <th>last update</th>
                         <th>Arrival Status</th>
                         <th>action</th>
                         <th>Stock</th>
                    </tr>
                </thead>
         
              
                <tbody >
                          <?
                             $sql="SELECT * FROM `product` where delete_status='0'";
                             if($value==1)
                              {
                               $sql.=" AND arrival_status='".$value."'";
                             
                              }
                              $sql.= " ORDER BY `id` DESC"; 

                             $sqlPRODUCTS=mysqli_query($conn,$sql);                      
                             while($show=mysqli_fetch_assoc($sqlPRODUCTS)){                    
                                $id++;       
                             
                                $date=date('d/m/Y',$show['strtotime']);                    
                             
                                $time=date('h:i A',$show['strtotime']);                     
                             
                                $view=mysqli_fetch_array(mysqli_query($conn,"SELECT * FROM `brand` WHERE `id`='".$show['brand_id']."'"));
                                $views=mysqli_fetch_array(mysqli_query($conn,"SELECT * FROM `sub_brand` WHERE `id`='".$show['subbrand_id']."'"));
     $color =mysqli_query($conn,"SELECT * FROM `product_color` where product_id='".$show['id']."'");
            $count1=mysqli_num_rows($color);
          
       $model    = mysqli_query($conn,"SELECT * FROM `product_model` where product_id='".$show['id']."'");   
           $count2=mysqli_num_rows($model);              
                             ?>
                          <tr>
                            <td></td>
                             <td class="f"><?php echo $id;?></td>
                             <td>
                                <div class="img_block">
                                   <?php if(!empty($show['images'])){?>
                                   <img src="image/<?php echo $show['images'];?>" width="120px" />
                                   <?php } else { ?>
                                   <img src="loader_img/Tokayo_logo.png" width="120px" />
                                   <?php }?>
                                </div>
                             </td>
                             <td>
                                <strong><?php echo $show['name'];?></strong>
                             </td>
                             <td><?php echo $view['name'];?></td>
                             <td><?php echo $views['name'];?></td>
                             <td><?php echo number_format($show['price'],2);?></td>
                             <td><?php echo $show['weight'];?></td>
                             <td><?php echo $show['stock'];?></td>
                             <td>Available</td>
                             <td><?php if($show['arrival_status']==1) { echo "Arrival Product"; }else { echo "Normal Product"; } ?></td>
                             <td>
                                <?php echo $date;?><br />
                                <?php echo $time;?>
                             </td>
                             <td><?php if($show['arrival_status']==1)
                              { 
                                echo '<input type="Checkbox" checked>'; 
                              }
                              
                               ?></td>
                             <td>
                                <div class="option_div">
                                   <a href="edit_products.php?edit=<?php echo $show['id'];?>" class="btn btn-primary Edit"><i class="fa fa-pencil"></i></a>
                                   <a onclick="return confirm ('Are you sure delete?')" href="?delete_id=<?php echo $show['id']?>"  class="btn btn-primary Delete">
                                   <i class="fa fa-trash"></i></a>

                                   <a href="view_more.php?view=<?php echo $show['id'];?>" class="btn btn-primary Edit"><i class="fa fa-eye"></i></a>
                                 </div>
                              </td>
                              <td>
                                 <div class="option_div">
                                 <?php if($count1>0)
                                 {
                                echo    '<a href="add_color_stock.php?edit='.$show["id"].'" class="btn btn-primary Edit">Add Color Stock</a>';
                                 }
                                
                                if ($count2>0)
                                {
                                  echo  '<a href="add_model_stock.php?edit='.$show["id"].'" class="btn btn-primary Edit">Add Model Stock</a>';
                                }
                                ?>
                                </div>

                             </td>
                          </tr>
                          <?php } ?>  


                           </tbody>
            </table>