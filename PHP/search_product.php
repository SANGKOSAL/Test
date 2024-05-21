<?php include("Function_P.php");

    function search(){
        global $connection;
        if (isset($_GET['btn-search'])){
            $search = $_GET['txtsearch'];
            $rs = $connection->query("SELECT * FROM `tbl_product` WHERE `name` LIKE '%$search%'");
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
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Link bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <!-- link icon bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- Link css -->
    <link rel="stylesheet" href="../CSS/Product.css">
    <!-- Link icon -->
    <link rel="icon" href="../Image/L1.png">
    <title>TAPPERS</title>
</head>
<body>
    <div class="web-page">
        <nav class="header fixed-top">
            <div class="logo">
                <a href="#">
                    <img src="../Image/L1.png" alt="">
                </a>
            </div>
            <div class="navbar navbar-expand-lg">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a href="Product.php" class="nav-link">HOME</a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">ABOUT US</a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">OUR BRANDS</a>
                    </li>
                    <li class="nav-item">                        
                        <a href="#sale-product" class="nav-link">SALES PRODUCTS</a>
                    </li>
                    <li class="nav-item">
                        <a href="#contact" class="nav-link">CONTACT</a>
                    </li>
                </ul>
            </div>
            <div class="search">
                <form action="search_product.php" method="get">
                    <input type="text" name="txtsearch" id="txtsearch" placeholder="Search Product...">
                    <button type="submit" name="btn-search" id="btn-search"><i class="bi bi-search"></i> Search</button>
                </form>
            </div>
        </nav>
        <main class="content">
            <div class="row row1">
                <div class="col-4">
                    <div class="header-content">
                        <img src="../Image/L1.png" alt="">
                        <div class="total-product">
                            Total Products: <?php ProductCuount();?>
                        </div>
                        <button type="button" id="btn-open-BuyNow" name="btn-open-BuyNow" class="btn btn-content" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                            <i class="bi bi-basket2"></i> Buy Now!
                        </button>
                        <!-- Modal Buy Now -->
                        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="staticBackdropLabel">DATA FROM CUSTOMER</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="" method="post" enctype="multipart/form-data">
                                        <label for="" id="labelcode">CODE:</label>
                                        <input type="text" name="txtcode" id="txtcode" class="form-control">
                                        <label for="">NAME:</label>
                                        <input type="text" name="txtname" id="txtname" placeholder="Enter Name Product..." class="form-control">
                                        <label for="">QUANTITY:</label>
                                        <input type="text" name="txtqty" id="txtqty" placeholder="Enter Quantity Product..." class="form-control">
                                        <label for="">PRICE:</label>
                                        <input type="text" name="txtprice" id="txtprice" placeholder="Enter Price Product..." class="form-control">
                                        <label for="">IMAGE:</label>
                                        <input type="file" name="txtimage" id="txtimage"class="form-control">
                                        
                                        <div class="box-image" id="box-image">
                                            <img src="" id="show-image" alt="" class="show-image">
                                        </div>
                                            <input type="hidden" id="old-image" name="old-image" class="form-control my-2 text-center">

                                        <div class="button-footer">
                                            <button type="submit" class="btn btn-cancel" data-bs-dismiss="modal"><i class="bi bi-x-circle"></i> CANCEL</button>
                                            <button type="submit" name="btn-buy-now" id="btn-buy-now" class="btn btn-buy-now"><i class="bi bi-bag-heart"></i> BUY NOW</button>
                                            <button type="submit" name="btn-update" id="btn-update" class="btn btn-update"><i class="bi bi-box-arrow-in-up"></i> UPDATE PRODUCT</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        </div>
                    </div>
                    <div class="slide-content">
                        <div id="carouselExampleInterval" class="carousel slide" data-bs-ride="carousel">
                            <div class="carousel-inner">
                                <div class="carousel-item active" data-bs-interval="6000">
                                    <img src="../Image/p1.png" class="d-block w-100" alt="...">
                                </div>
                                <div class="carousel-item" data-bs-interval="3000">
                                    <img src="../Image/p2.jpg" class="d-block w-100" alt="...">
                                </div>
                                <div class="carousel-item" data-bs-interval="3000">
                                    <img src="../Image/p3.jpg" class="d-block w-100" alt="...">
                                </div>
                                <div class="carousel-item" data-bs-interval="3000">
                                    <img src="../Image/p4.jpg" class="d-block w-100" alt="...">
                                </div>
                                <div class="carousel-item" data-bs-interval="3000">
                                    <img src="../Image/p5.jpg" class="d-block w-100" alt="...">
                                </div>
                                <div class="carousel-item" data-bs-interval="3000">
                                    <img src="../Image/p6.jpg" class="d-block w-100" alt="...">
                                </div>
                                <div class="carousel-item">
                                    <img src="../Image/p7.jpg" class="d-block w-100" alt="...">
                                </div>
                                <div class="carousel-item">
                                    <img src="../Image/ABC BEER.jpg" class="d-block w-100" alt="...">
                                </div>
                                <div class="carousel-item">
                                    <img src="../Image/Tiger beer.jpg" class="d-block w-100" alt="...">
                                </div>
                                <div class="carousel-item">
                                    <img src="../Image/Jinro beer.jpg" class="d-block w-100" alt="...">
                                </div>
                            </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="prev">
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="next">
                        </button>
                        </div>
                    </div>
                </div>
                <section class="col-8" id="sale-product">
                    <h2 class="txt-bar">INFORMATION CUSTOMER BUY PRODUCTS</h2>
                    <table class="table align-middle">
                        <thead>
                            <th>CODE</th>
                            <th>NAME</th>
                            <th>QUANTITY</th>
                            <th>PRICE</th>
                            <th>TOTAL</th>
                            <th>IMAGE</th>
                            <th>ACTION</th>
                        </thead>
                        <tbody>
                            <?php
                                search();
                            ?>
                        </tbody>
                    </table>
                </section>
                <footer class="footer-content">
                    <div class="row">
                        <div class="col-6 logo-footer">
                            <a href="http://localhost/Product/PHP/Product.php">
                                <img src="../Image/L1.png" alt="">TAPPERS
                            </a>
                            <p>សូមអរគុណ ឪកាសក្រោយអញ្ជើញមកម្តងទៀត!</p>
                            <p>THANK YOU FOR COMING AGAIN!</p>
                        </div>
                        <div class="col-6 text-footer">
                            <section id="contact">
                                <h3>CONTACT ME</h3>
                                <div class="navbar navbar-expand-lg">
                                    <ul class="navbar-nav">
                                        <li class="nav-item">
                                            <a href="https://www.facebook.com/eteccenter?mibextid=hu50Ix" class="nav-link"><i class="bi bi-facebook"></i></a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="https://t.me/familykroitchetlaor" class="nav-link"><i class="bi bi-telegram"></i></a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="https://www.facebook.com/kroitchetlaor?mibextid=hu50Ix" class="nav-link"><i class="bi bi-person-circle"></i></a>
                                        </li>
                                    </ul>
                                </div>
                                <p style="font-size: 15px;">ម្តុំមុខភូមិន្ទភ្នំពេញ 300ម, មុខផ្លាកសំណង់១២ និង នៅក្រោយសាលា ប៊ែលធី ២០០ម (មុខពេទ្យមេរា) , Phnom Penh, Cambodia</p>
                                <p><i class="bi bi-telephone-forward-fill"></i> 096 226 888 4 / 077 35 888 4 |<span><i class="bi bi-geo-alt-fill"></i><a href="https://maps.app.goo.gl/CErwhSbyyDHxnmV67">Location ETEC</a></span></p>
                            </section>
                        </div>
                    </div>
                </footer>
            </div>
        </main>
    </div>
    <!-- Modal Delete -->
    <div class="modal fade" id="staticBackdrop1" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="staticBackdropLabel">Delete Information Student</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="" method="post" enctype="multipart/form-data">
                <h5 class="text-center align-middle ">Do you really want to delete your product?</h5>
                <p class="text-center align-middle">If not, click <strong class="text-danger">NO</strong>&ensp;&ensp;&ensp;If delete, click <strong class="text-primary">YES</strong></p>
                <input type="hidden" name="deletecode" id="deletecode" class="form-control my-2" placeholder="ID Student...">
                <button type="submit" name="btn-no" id="btn-no" class="btn btn-danger" data-bs-dismiss="modal">NO</button>
                <button type="submit" name="btn-yes" id="btn-yes" class="btn btn-primary btn-yes">YES</button>
            </form>
        </div>
        </div>
    </div>
    </div>
</body>
</html>
<script>
function clear(){
    $('#txtcode').val();
    $('#txtname').val();
    $('#txtqty').val();
    $('#txtprice').val(); 
    $('#txttotal').val();
    $('#txtimage').val();
  }
  $(document).ready(function(){
    $('#btn-open-BuyNow').click(function(){
        clear();
        $('#btn-update').hide();
        $('#labelcode').hide();
        $('#txtcode').hide( );
        $('#btn-buy-now').show();
        $('#box-image').hide();
    });
    $('.web-page').on('click','#btn-open-Update',function(){

        $('#labelcode').show();
        $('#txtcode').show( );
        $('#btn-update').show();
        $('#box-image').show();
        $('#btn-buy-now').hide();

        var code = $(this).parents('tr').find('td').eq(0).text();
        var name =$(this).parents('tr').find('td').eq(1).text();
        var qty = $(this).parents('tr').find('td').eq(2).text();
        var price = $(this).parents('tr').find('td').eq(3).text();
        var total = $(this).parents('tr').find('td').eq(4).text();
        var image = $(this).parents('tr').find('td').eq(5).find('img').attr('alt');

        $('#txtcode').val(code);
        $('#txtname').val(name);
        $('#txtqty').val(qty);
        $('#txtprice').val(price);
        $('#txttotal').val(total);
        $('#show-image').attr('src','../IMG/'+image);
        $('#old-image').val(image);

    });

    $('.web-page').on('click','#btn-open-Delete',function(){
      var code = $(this).parents('tr').find('td').eq(0).text();
      $('#deletecode').val(code);
    });
});
</script>