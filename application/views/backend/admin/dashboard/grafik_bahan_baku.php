<script>
    var ctx = document.getElementById("chart_bahan_baku").getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: <?php echo $bulan_tahun_masuk; ?>, 
            datasets: [
                {
                    label               : 'Masuk',
                    backgroundColor     : 'rgba(40, 167, 69, 0.8)',
                    borderColor         : 'rgba(40, 167, 69, 0.8)',
                    pointRadius          : true,
                    pointColor          : '#28a745',
                    pointStrokeColor    : 'rgba(40, 167, 69, 0.8)',
                    pointHighlightFill  : '#fff',
                    pointHighlightStroke: 'rgba(40, 167, 69, 1)',
                    data                : <?php echo $jumlah_masuk; ?>
                },
                {
                    label               : 'Keluar',
                    backgroundColor     : 'rgba(220, 53, 69, 0.8)',
                    borderColor         : 'rgba(220, 53, 69, 0.8)',
                    pointRadius         : true,
                    pointColor          : '#dc3545',
                    pointStrokeColor    : 'rgba(220, 53, 69, 0.8)',
                    pointHighlightFill  : '#fff',
                    pointHighlightStroke: 'rgba(220, 53, 69,1)',
                    data                : <?php echo $jumlah_keluar; ?>
                },
                {
                    label               : 'Retur',
                    backgroundColor     : 'rgba(111, 66, 193, 0.8)',
                    borderColor         : 'rgba(111, 66, 193, 0.8)',
                    pointRadius         : true,
                    pointColor          : '#6f42c1',
                    pointStrokeColor    : 'rgba(111, 66, 193, 0.8)',
                    pointHighlightFill  : '#fff',
                    pointHighlightStroke: 'rgba(111, 66, 193,1)',
                    data                : <?php echo $jumlah_retur; ?>
                },
            ],
        },
        options: {
            maintainAspectRatio : false,
            responsive : true,
            legend: {
                position: "bottom"
            },
            scales: {
                xAxes: [{
                    gridLines : {
                        display : false,
                    }
                }],
                yAxes: [{
                    gridLines : {
                        display : false,
                    }
                }]
            }                                    
        }
    });
</script>

