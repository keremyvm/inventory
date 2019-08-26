 var line = new Morris.Line({
    element          : 'line-chart-ventas',
    resize           : true,
    data             : [
      { y: '2011 Q1', ventas: 2666 },
      { y: '2012 Q2', ventas: 2778 },
      { y: '2013 Q3', ventas: 4912 },
      { y: '2014 Q4', ventas: 4912 }
    ],
    xkey             : 'y',
    ykeys            : ['ventas'],
    labels           : ['Ventas'],
    lineColors       : ['#efefef'],
    lineWidth        : 2,
    hideHover        : 'auto',
    gridTextColor    : '#fff',
    gridStrokeWidth  : 0.4,
    pointSize        : 4,
    pointStrokeColors: ['#efefef'],
    gridLineColor    : '#efefef',
    gridTextFamily   : 'Open Sans',
    gridTextSize     : 10,
    preUnits        : '$'
  });
//-----------------------------------------------------