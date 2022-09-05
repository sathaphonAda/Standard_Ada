<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>Hello, world!</title>

  </head>
  <body>
  <div class="account-pages my-5 pt-sm-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6 col-xl-5">
                    <div class="card overflow-hidden">
                        <div class="bg-soft-primary">
                            <div class="row">
                                <div class="col-12">
                                    <div class="text-primary p-4" style="color: #fff">
                                        <p>Standard_Ada Register From API</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body pt-0"> 
                            <div class="p-0">
                                <form class="form-horizontal" name="ofmRegister" id="ofmRegister" method="post">
                                    <div class="form-group">
                                        <label for="ocmTitleName"><?php echo language('register/register','titlename');?> </label>
                                        <select name="ocmTitleName" id="ocmTitleName" class="form-control">
                                            <option value="">กรุณาเลือก</option>
                                            <option value="นาย">นาย</option>
                                            <option value="นางสาว">นางสาว</option>
                                        </select>
                                    </div>
                                   <div class="form-group">
                                        <label for="oetFristName"><?php echo language('register/register','fristname');?></label>
                                        <input type="text" class="form-control" id="oetFristName" id="oetFristName" value="">
                                    </div>
                                    <div class="form-group">
                                        <label for="oetLastName"><?php echo language('register/register','lastname');?></label>
                                        <input type="text" class="form-control" id="oetLastName" id="oetLastName" value="">
                                    </div>
                                    <div class="form-group">
                                        <label for="oemEmail"><?php echo language('register/register','email');?></label>
                                        <input type="email" class="form-control" id="oemEmail" id="oemEmail" value="">
                                    </div>
                                    <div class="form-group">
                                        <label for="ocmTeamCode"><?php echo language('register/register','teamcode'); ?></label>
                                        <select name="ocmTeamCode" id="ocmTeamCode" class="form-control">
                                            <option value="">กรุณาเลือก</option>
                                            <option value="นาย">Programmer</option>
                                            <option value="นางสาว">BA</option>
                                            <option value="นางสาว">IT</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="ocmPostionCode"><?php echo language('register/register','positon'); ?></label>
                                        <select name="ocmPostionCode" id="ocmPostionCode" class="form-control">
                                            <option value="">กรุณาเลือก</option>
                                            <option value="นาย">Programmer</option>
                                            <option value="นางสาว">BA</option>
                                            <option value="นางสาว">IT</option>
                                        </select>
                                    </div>
                                    <div class="mt-3">
                                        <button class="btn btn-primary btn-block waves-effect waves-light" type="submit" name="osmRegister" id="osmRegister"><?php echo language('register/register','btnsubmit');?></button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>