// Bar chart
/*

		new Chart(document.getElementById("chart-collections"), {
			type: 'bar',
			data: {
				labels: ["BSCRIM", "BSIT", "BSED", "BEED", "BSAT"],
				datasets: [
					{
						label: "Collections",
						backgroundColor: ["#51EAEA", "#FCDDB0",
							"#FF9D76", "#FB3569", "#82CD47"],
						data: [478, 267, 829, 1732, 1213]
					}
				]
			},
			options: {
				legend: { display: false },
				title: {
					display: true,
					text: 'Collections sample bar chart'
				}
			}
		});

		
		*/
function show_chart(clabels,first,second,total,chart_title) {
	// body...
            const chartdata = {
                labels: clabels,
                datasets: [{
                        label: 'First semester collections',
                        backgroundColor: 'rgba(0, 159, 255, 0.7)',
                        borderColor: 'rgba(200, 200, 200, 0.75)',
                        data: first
                    },
                    {
                        label: 'Second semester collections',
                        backgroundColor: 'rgba(255, 113, 71, 0.7)',
                        borderColor: 'rgba(200, 200, 200, 0.75)',
                        data: second
                    },
                    {
                        label: 'Total collections',
                        backgroundColor: 'rgba(120, 120, 120,0.7)',
                        borderColor: 'rgba(200, 200, 200, 0.75)',
                        data: total
                    }
                ]
            };

             var ctx = $("#charts-collections");

           /* const plugin = {
			  id: 'customCanvasBackgroundColor',
			  beforeDraw: (chart, args, options) => {
			    const {ctx} = chart;
			    ctx.save();
			    ctx.globalCompositeOperation = 'destination-over';
			    ctx.fillStyle = options.color || '#99ffff';
			    ctx.fillRect(0, 0, chart.width, chart.height);
			    ctx.restore();
			  }
			};
			*/

            var barGraph = new Chart(ctx, {
                type: 'bar',
                data: chartdata,
                options: {
                    barValueSpacing: 20,
                    title: {
                        display: true,
                        text: [chart_title + ' Collections'],
                        fontSize: 20
                    },
                    scales: {
                        xAxes: [{
                            scaleLabel: {
                                display: true,
                                labelString: 'Course'
                            }
                        }],
                        yAxes: [{
                            scaleLabel: {
                                display: true,
                                labelString: 'Collections amount'
                            },
                            ticks: {
                                beginAtZero: true
                            }
                        }]
                    }
                }

            });

}


function getData(url) {
	// body...
		const canvas = document.getElementById("charts-collections");
		console.log(canvas)
		if(canvas == null){
			return false;
		}
	$.ajax({
		url:'<?=site_url('charts/getCollectionData')?>',
		dataType:'json',
		success:function(response){
			let sy = $('select[name="year_id"] option:selected').text()
			
			show_chart(response.labels,response.first,response.second,response.total,sy);
		}
	})
}
$(function() {
	// body...
	getData();

	$('.btn-download').on('click',function(){
		//alert('Download');
		const canvas = document.getElementById("charts-collections");
		$(this).attr('href',canvas.toDataURL());
		$(this).attr('download','hello.png');
	})
})