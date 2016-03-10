// $(function() {
//     Morris.Area({
//         element: 'morris-area-chart',
//         data: [{
//             p: myfun(0),
//             fti: parseInt(myfun(1)),
//             ftp : parseInt(myfun(2))
//         },{
//             p: myfun(3),
//             fti: parseInt(myfun(4)),
//             ftp : parseInt(myfun(5))
//         },{
//             p: myfun(6),
//             fti: parseInt(myfun(7)),
//             ftp : parseInt(myfun(8))
//         },{
//             p: myfun(9),
//             fti: parseInt(myfun(10)),
//             ftp : parseInt(myfun(11))
//         },{
//             p: myfun(12),
//             fti: parseInt(myfun(13)),
//             ftp : parseInt(myfun(14))
//         },
//         {
//             p: myfun(15),
//             fti: parseInt(myfun(16)),
//             ftp : parseInt(myfun(17))
//         },{
//             p: myfun(18),
//             fti: parseInt(myfun(19)),
//             ftp : parseInt(myfun(20))
//         }
//         ] ,
//         xkey: 'p',
//         ykeys: ['fti', 'ftp'],
//         labels: ['Food Talk India', 'Food Talk Plus'],
//         pointSize: 2,
//         hideHover: 'auto',
//         resize: true
//     });

//     Morris.Donut({
//         element: 'morris-donut-chart',
//         data: [{
//             label: "Download Sales",
//             value: 12
//         }, {
//             label: "In-Store Sales",
//             value: 30
//         }, {
//             label: "Mail-Order Sales",
//             value: 20
//         }],
//         resize: true
//     });

    // Morris.Bar({
    //     element: 'morris-area-chart',
    //     data: [{
    //         y: '2006',
    //         a: 100,
    //         b: 90
    //     }, {
    //         y: '2007',
    //         a: 75,
    //         b: 65
    //     }, {
    //         y: '2008',
    //         a: 50,
    //         b: 40
    //     }, {
    //         y: '2009',
    //         a: 75,
    //         b: 65
    //     }, {
    //         y: '2010',
    //         a: 50,
    //         b: 40
    //     }, {
    //         y: '2011',
    //         a: 75,
    //         b: 65
    //     }, {
    //         y: '2012',
    //         a: 100,
    //         b: 90
    //     }],
    //     xkey: 'y',
    //     ykeys: ['a', 'b'],
    //     labels: ['Series A', 'Series B'],
    //     hideHover: 'auto',
    //     resize: true
    // });
    // myfun();
// });
$(function() {
    var data = [];
    var j = 0;
     $.ajax({
        url: "../gapi/index.php",
        dataType: 'json',
      }).done(function(response){
        for (var i = 0; i < 15; i++) {
            data.push({
                y: response[j],
                a: parseInt(response[j+1]),
                b: parseInt(response[j+2])
            });
            j = j+3;
        }
        console.log(data);
        Morris.Line({
          element: 'morris-area-chart',
          data: data,
          parseTime: false,
          xkey: 'y',
          ykeys: ['a', 'b'],
          labels: ['Food Talk India', 'Food Talk Plus'],
          hideHover: 'auto',
          resize: true
        });
      });
});
