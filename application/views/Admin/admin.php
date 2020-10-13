<div class="container-flex pt-3" style="background-color:#b5192e;">

    <div class="row no-gutters pt-4 bg-dark">
        <div class="col-sm-12 col-lg-12 col-xl-12 ">
            <h3 class="text-center text-light">Admin Panel</h3>
        </div>
    </div>

    <div class="row no-gutters pt-4 bg-dark text-center">
        <div class="col-sm-12 col-lg-12 col-xl-12 ">
            <button class="btn btn-sm btn-danger mr-1" onclick="show_table()">Add Tables</button>
            <button class="btn btn-sm btn-danger mr-1" onclick="show_category()">Add Category</button>
            <button class="btn btn-sm btn-danger mr-1" onclick="show_menu()">Add Menu Items</button>
            <button class="btn btn-sm btn-danger mr-1" onclick="show_price()">Add Price & Size</button>
            <button class="btn btn-sm btn-danger mr-1" onclick="show_report()">Sales Report</button>
            <hr class="align-cneter" width="50%">
        </div>
    </div>

    <div class="row no-gutters text-white pt-4 bg-dark add_table">
        <div class="col-sm-12 col-lg-12 col-xl-12 text-center">
            <center>
                <div class="card w-75 bg-dark shadow">
                    <?php form_open() ?>
                    <div class="card-header">
                        <h3>Add Table</h3>
                    </div>
                    <div class="card-body">
                        <p class="card-text">

                            <input class="form-control" type="text" name="table_no" placeholder="Enter Table No">
                            <br>
                            <input class="form-control" type="text" name="status" disabled value="0">
                            <span class="text-light" style="font-size:12px;">Whenever you add table Enetr status "0"</span>
                            </form>
                        </p>

                    </div>
                    <div class="card-footer text-muted">
                        <button class="btn btn-md btn-danger" type="submit">Submit</button>
                    </div>
                    </form>
                </div>
            </center>
        </div>
    </div>
    <div class="row no-gutters text-white pt-4 bg-dark text-center add_category">
        <div class="col-sm-12 col-lg-12 col-xl-12 text-center">
            <center>
                <div class="card w-75 bg-dark shadow">
                    <?php form_open() ?>
                    <div class="card-header">
                        <h3>Add Category</h3>
                    </div>
                    <div class="card-body">
                        <p class="card-text">

                            <input class="form-control" type="text" name="category_name" placeholder="Enter Category Name">
                            <br>

                            </form>
                        </p>

                    </div>
                    <div class="card-footer text-muted">
                        <button class="btn btn-md btn-danger" type="submit">Submit</button>
                    </div>
                    </form>
                </div>
            </center>
        </div>
    </div>
        <div class="row no-gutters text-white pt-4 bg-dark add_menu">
            <div class="col-sm-12 col-lg-12 col-xl-12 ">

               <center>
                <div class="card w-75 bg-dark shadow">
                    <?php form_open() ?>
                    <div class="card-header">
                        <h3>Add Menu</h3>
                    </div>
                    <div class="card-body">
                        <p class="card-text">

                            <input class="form-control" type="text" name="item_name" placeholder="Enter item Name">
                            <br>
                           
                            <select class="form-control" name="category_name" >
                                <option>Category Name</option>
                                
                            </select>
                            <br>
                            <input class="form-control" type="file" name="item_image">
                            <br>

                            </form>
                        </p>

                    </div>
                    <div class="card-footer text-muted">
                        <button class="btn btn-md btn-danger" type="submit">Submit</button>
                    </div>
                    </form>
                </div>
            </center>
            </div>
        </div>
        <div class="row no-gutters text-white pt-4 bg-dark text-center add_price">
            <div class="col-sm-12 col-lg-12 col-xl-12 ">
            <center>
                <div class="card w-75 bg-dark shadow">
                    <?php form_open() ?>
                    <div class="card-header">
                        <h3>Add Price And Size</h3>
                    </div>
                    <div class="card-body">
                        <p class="card-text">

                            <select class="form-control" name="category_name" >
                                <option>Category Name</option>
                                
                            </select>
                            <br>
                            <select class="form-control" name="item_name" >
                                <option>Item Name</option>
                                
                            </select>
                            <br>
                            
                            <input class="form-control" type="text" name="item_name" placeholder="Price">
                            <br>
                            <input class="form-control" type="text" name="item_name" placeholder="Size">
                            <br>
                           

                            </form>
                        </p>

                    </div>
                    <div class="card-footer text-muted">
                        <button class="btn btn-md btn-danger" type="submit">Submit</button>
                    </div>
                    </form>
                </div>
            </center>
            </div>
        </div>
        <div class="row no-gutters text-white pt-4 bg-dark text-center sales">
            <div class="col-sm-12 col-lg-12 col-xl-12 ">
                sales report
            </div>
        </div>

</div>

    <script>
        $(document).ready(function() {
            $('.add_table').hide();
            $('.add_category').hide();
            $('.add_menu').hide();
            $('.add_price').hide();
            $('.sales').hide();
        });

        function show_table() {
            $('.add_table').show();
            $('.add_category').hide();
            $('.add_menu').hide();
            $('.add_price').hide();
            $('.sales').hide();

        }

        function show_category() {
            $('.add_table').hide();
            $('.add_category').show();
            $('.add_menu').hide();
            $('.add_price').hide();
            $('.sales').hide();

        }

        function show_menu() {
            $('.add_table').hide();
            $('.add_category').hide();
            $('.add_menu').show();
            $('.add_price').hide();
            $('.sales').hide();

        }

        function show_price() {
            $('.add_table').hide();
            $('.add_category').hide();
            $('.add_menu').hide();
            $('.add_price').show();
            $('.sales').hide();

        }

        function show_report() {
            $('.add_table').hide();
            $('.add_category').hide();
            $('.add_menu').hide();
            $('.add_price').hide();
            $('.sales').show();

        }
    </script>