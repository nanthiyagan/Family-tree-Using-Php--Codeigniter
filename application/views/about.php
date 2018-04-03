<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" contenqt="width=device-width">
    <title> Basic example </title>
    <link rel="stylesheet" href="http://fperucic.github.io/treant-js/Treant.css">
    <link rel="stylesheet" href="http://fperucic.github.io/treant-js/examples/basic-example/basic-example.css">
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.5.0-alpha2/html2canvas.min.js"></script>

    <style>
        .Treant > .node img {

            width: 68px;
            height: 64px;
        }
        .node-name{
            text-align: center;
        }
        body{
            background:#427fbb !important;
        }
        .nodeExample1{border:0px !important;}
        .chart{width:100% !important;    overflow: scroll;
        }
    </style>
</head>
<body>

<div class="chart" id="basic-example"></div>
<script src="http://fperucic.github.io/treant-js/vendor/raphael.js"></script>
<script src="http://fperucic.github.io/treant-js/Treant.js"></script>

<script src="http://fperucic.github.io/treant-js/examples/basic-example/basic-example.js"></script>
<script type="text/javascript">
    var config = {
        container: "#basic-example",

        connectors: {
            type: 'step'
        },
        node: {
            HTMLclass: 'nodeExample1'
        }
    };
    <?php foreach ($contents as $key=>$value) {
    if($value->parent_id == "" || $value->parent_id == null || $value->parent_id == 0){ ?>
        var node<?php echo $value->id; ?> = {
            text: {
                name: "<?php echo $value->name ?>",
            },
           // image: "http://34.197.72.79/schoolerp_qa/profile/admin/98731520841370.jpg"
        };
 <?php   }else{ ?>
       var node<?php echo $value->id; ?> = {
            parent: <?php echo "node".$value->parent_id ?>,
            text: {
                name: "<?php echo $value->name ?>",
            },
            //image: "http://34.197.72.79/schoolerp_qa/profile/admin/98731520841370.jpg"
        };
  <?php  } ?>
    <?php  }   ?>
    var  chart_config = [];
      chart_config.push(config);
<?php foreach ($contents as $key=>$value) { ?>
     chart_config.push(node<?php echo $value->id; ?>)
<?php  } ?>

    new Treant( chart_config );

    setTimeout(function(){
        $("path").attr("stroke", "#ffffff")
    }, 5000);


</script>
</body>
</html>