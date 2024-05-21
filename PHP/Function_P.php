<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<?php
    $connection = new mysqli ('localhost','root','','db_product');
    date_default_timezone_set('Asia/Phnom_Penh');
    function insert(){
        global $connection;
        if (isset($_POST['btn-buy-now'])){
            $name = $_POST['txtname'];
            $qty = $_POST['txtqty'];
            $price = $_POST['txtprice'];
            $image = $_FILES['txtimage']['name'];
            
            if( !empty($name) && !empty($qty) && !empty($price) && !empty($image) ){
                
                $image = date('dmyhis').'-'.$image;
                $path = '../IMG/'.$image;
                move_uploaded_file($_FILES['txtimage']['tmp_name'],$path);
                
                $total = $qty * $price;

                $sql = "INSERT INTO `tbl_product`(`name`, `qty`, `price`, `total`,`image`) 
                        VALUES ('$name','$qty','$price','$total','$image')";
                $rs = $connection->query($sql);   
                if($rs){
                    echo '
                        <script>
                            $(document).ready(function(){
                                swal({
                                    title: "Thank you!",
                                    text: "See you again!",
                                    icon: "success",
                                    button: "Thank you!",
                                    });
                            });
                        </script>
                    ';
                }
            }
            else {
                echo '
                    <script>
                        $(document).ready(function(){
                            swal({
                                title: "Not success",
                                text: "Please, you check information again!",
                                icon: "error",
                                button: "Thank you!",
                                });
                        });
                    </script>
                ';
            }
        }
    }
    insert();
    function GetData(){
        global $connection;
        $rs = $connection->query("SELECT * FROM `tbl_product`");
        while($row = mysqli_fetch_assoc($rs)){
            echo'
                <tr>
                    <td>'.$row['code'].'</td>
                    <td>'.$row['name'].'</td>
                    <td>'.$row['qty'].'</td>
                    <td>'.$row['price'].'</td>
                    <td>$ '.$row['total'].'</td>
                    <td><img src="../IMG/'.$row['image'].'" alt="'.$row['image'].'" class="Image-product"></td>
                    <td>
                        <button class="btn update mb-sm-2" id="btn-open-Update" name="btn-open-Update" data-bs-toggle="modal" data-bs-target="#staticBackdrop"><i class="bi bi-box-arrow-in-down"></i> Update</button>
                        <button class="btn delete mb-sm-2" id="btn-open-Delete" name="btn-open-Delete" data-bs-toggle="modal" data-bs-target="#staticBackdrop1"><i class="bi bi-trash3-fill"></i> Delete</button>
                    </td>
                </tr>
            ';
        }
    }

    function update(){
        global $connection;
        if (isset($_POST['btn-update'])){
            $code = $_POST['txtcode'];
            $name = $_POST['txtname'];
            $qty = $_POST['txtqty'];
            $price = $_POST['txtprice'];
            $image = $_FILES['txtimage']['name'];

            if ($image){

                $image = date('dmyhis').'-'.$image;
                $path = '../IMG/'.$image;
                move_uploaded_file($_FILES['txtimage']['tmp_name'],$path);
                
            }
            else{
                $image = $_POST['old-image'];
            }

            if( !empty($name) && !empty($qty) && !empty($price) && !empty($image) ){

                $total = $qty * $price;

                $sql = "UPDATE `tbl_product` SET `name`='$name',`qty`='$qty',`price`='$price',`total`='$total',`image`='$image' WHERE `code` = '$code'";
                $rs = $connection->query($sql);   
                if($rs){
                    echo '
                        <script>
                            $(document).ready(function(){
                                swal({
                                    title: "Thank you!",
                                    text: "See you again!",
                                    icon: "success",
                                    button: "Thank you!",
                                    });
                            });
                        </script>
                    ';
                }
            }
            else {
                echo '
                    <script>
                        $(document).ready(function(){
                            swal({
                                title: "Not success",
                                text: "Please, you check information update again!",
                                icon: "error",
                                button: "Thank you!",
                                });
                        });
                    </script>
                ';
            }
        }
    }
    update();

    function Delete(){
        global $connection;
        if (isset($_POST['btn-yes'])){
            $code_delete = $_POST['deletecode'];
            $sql = "DELETE FROM `tbl_product` WHERE `code` = '$code_delete'";
            $rs = $connection->query($sql);
            if ($rs){
                echo '
                    <script>
                        $(document).ready(function(){
                            swal({
                                title: "Delete success",
                                text: "Good bye!",
                                icon: "success",
                                button: "Thank you!",
                            });
                        });
                    </script>
                ';
            }
        }
    }
    Delete();
    
    function ProductCuount(){
        global $connection;
        $rs = $connection->query("SELECT COUNT(`code`) 'total' FROM `tbl_product`");
        $row = mysqli_fetch_assoc($rs);
        echo $row['total'];
    }
    