<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="{{ asset('img/favicon.png') }}">

    <title> Sequences</title></title>

    <!-- Bootstrap Core CSS - Uses Bootswatch Flatly Theme: http://bootswatch.com/flatly/ -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/freelancer.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css">

</head>

<body id="page-top" class="index">

    <!-- Navigation -->
    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header page-scroll">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="{{ url('index') }}"><img src="img/logo2.png" alt="logo" style = "margin-top: -25px;height: 67px;"></a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li class="hidden">
                        {!! Html::link('/') !!}
                    </li>
                    <li >
                        {!! Html::link('sequences', 'Sequences') !!}
                    </li>
                    <li >
                        {!! Html::link('list', 'Guide') !!}
                    </li>
                    <li >
                        {!! Html::link('upload', 'Upload Codon') !!}
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
    </nav>

    <!-- Portfolio Grid Section -->
    <section id="portfolio" style="margin-top: 50px;">
        <div class="container">
            <h1 style="color:#29788A">Result</h1>
            
            <h3 style="color:#29788A">RNA</h3>
            <div class="row">
                <div class="col-md-12" style="border-radius: 25px;border: 2px solid #2c3e50;padding: 20px;width: 100%;height: 100%;  ">
                    @foreach($result as $r)
                        {{$r}}
                    @endforeach
                </div>
            </div>
            
            <h3 style="color:#29788A">DNA</h3>
            <div class="row">
                <div class="col-md-12" style="border-radius: 25px;border: 2px solid #2c3e50;padding: 20px;width: 100%;height: 100%;  ">
                    @foreach($result as $r)
                        <?php echo str_replace("U", "T", $r) ?>
                    @endforeach
                </div>
            </div>
            
            <table class="table table-striped" style="margin-top:5%">
                <tr style="background-color:#2c3e50;color: white;">
                    <th>Amino acid</th>
                    <th>Triplet</th> 
                    <th>Synechocystis</th>
                    <th>Penicillium roquefortii</th>
                    <th>Escherichia coli K12</th>
                    <th>Rhodococcus sp. RHA1 </th>
                </tr>
                <?php $i = 0;?>
                @foreach($rf as $f)
                    <tr>
                        <td>{{$f}}</td>
                        <td>{{$result[$i]}}</td> 
                        <td>
                            <?php $freqs = DB::table('codon')->where('triplet', $result[$i])->where('type', 'Synechocystis' )->pluck('frequency');
                                echo $freqs[0];
                            ?>
                        </td>
                        <td>
                            <?php $freqp = DB::table('codon')->where('triplet', $result[$i])->where('type', 'Penicillium roquefortii' )->pluck('frequency');
                                echo $freqp[0];
                            ?>
                        </td>
                        <td>
                            <?php $freqe = DB::table('codon')->where('triplet', $result[$i])->where('type', 'Escherichia coli' )->pluck('frequency');
                                echo $freqe[0];
                            ?>
                        </td>
                        <td>
                            <?php $freqr = DB::table('codon')->where('triplet', $result[$i])->where('type', 'Rhodococcus' )->pluck('frequency');
                                echo $freqr[0];
                            ?>
                        </td>
                    </tr>
                <?php $i++; ?>
                @endforeach
            </table>
        </div>
    </section>

    

    <!-- Footer -->
    <footer class="text-center">
        <div class="footer-below">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        Copyright &copy; Your Website 2016
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- Scroll to Top Button (Only visible on small and extra-small screen sizes) -->
    <div class="scroll-top page-scroll visible-xs visible-sm">
        <a class="btn btn-primary" href="#page-top">
            <i class="fa fa-chevron-up"></i>
        </a>
    </div>


    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
    <script src="js/classie.js"></script>
    <script src="js/cbpAnimatedHeader.js"></script>

    <!-- Contact Form JavaScript -->
    <script src="js/jqBootstrapValidation.js"></script>
    <script src="js/contact_me.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="js/freelancer.js"></script>

</body>

</html>
