/*
 Highstock JS v11.0.1 (2023-05-08)

 Indicator series type for Highcharts Stock

 (c) 2010-2021 Pawe Dalek

 License: www.highcharts.com/license
*/
'use strict';(function(a){"object"===typeof module&&module.exports?(a["default"]=a,module.exports=a):"function"===typeof define&&define.amd?define("highcharts/indicators/volume-by-price",["highcharts","highcharts/modules/stock"],function(k){a(k);a.Highcharts=k;return a}):a("undefined"!==typeof Highcharts?Highcharts:void 0)})(function(a){function k(a,p,w,d){a.hasOwnProperty(p)||(a[p]=d.apply(null,w),"function"===typeof CustomEvent&&window.dispatchEvent(new CustomEvent("HighchartsModuleLoaded",{detail:{path:p,
module:a[p]}})))}a=a?a._modules:{};k(a,"Stock/Indicators/VBP/VBPPoint.js",[a["Core/Series/SeriesRegistry.js"]],function(a){var p=this&&this.__extends||function(){var a=function(d,b){a=Object.setPrototypeOf||{__proto__:[]}instanceof Array&&function(a,b){a.__proto__=b}||function(a,b){for(var d in b)Object.prototype.hasOwnProperty.call(b,d)&&(a[d]=b[d])};return a(d,b)};return function(d,b){function p(){this.constructor=d}if("function"!==typeof b&&null!==b)throw new TypeError("Class extends value "+String(b)+
" is not a constructor or null");a(d,b);d.prototype=null===b?Object.create(b):(p.prototype=b.prototype,new p)}}();return function(a){function d(){return null!==a&&a.apply(this,arguments)||this}p(d,a);d.prototype.destroy=function(){this.negativeGraphic&&(this.negativeGraphic=this.negativeGraphic.destroy());a.prototype.destroy.apply(this,arguments)};return d}(a.seriesTypes.sma.prototype.pointClass)});k(a,"Stock/Indicators/VBP/VBPIndicator.js",[a["Stock/Indicators/VBP/VBPPoint.js"],a["Core/Animation/AnimationUtilities.js"],
a["Core/Globals.js"],a["Core/Series/SeriesRegistry.js"],a["Core/Utilities.js"],a["Core/Chart/StockChart.js"]],function(a,p,k,d,b,H){var w=this&&this.__extends||function(){var a=function(b,c){a=Object.setPrototypeOf||{__proto__:[]}instanceof Array&&function(c,a){c.__proto__=a}||function(c,a){for(var n in a)Object.prototype.hasOwnProperty.call(a,n)&&(c[n]=a[n])};return a(b,c)};return function(b,c){function n(){this.constructor=b}if("function"!==typeof c&&null!==c)throw new TypeError("Class extends value "+
String(c)+" is not a constructor or null");a(b,c);b.prototype=null===c?Object.create(c):(n.prototype=c.prototype,new n)}}(),I=p.animObject;p=k.noop;k=d.seriesTypes;var y=k.column.prototype,D=k.sma,A=b.addEvent,E=b.arrayMax,J=b.arrayMin,B=b.correctFloat,F=b.defined,C=b.error,G=b.extend,K=b.isArray,L=b.merge,u=Math.abs;b=function(a){function b(){var c=null!==a&&a.apply(this,arguments)||this;c.data=void 0;c.negWidths=void 0;c.options=void 0;c.points=void 0;c.posWidths=void 0;c.priceZones=void 0;c.rangeStep=
void 0;c.volumeDataArray=void 0;c.zoneStarts=void 0;c.zoneLinesSVG=void 0;return c}w(b,a);b.prototype.init=function(c){var b=this;a.prototype.init.apply(b,arguments);var x=A(H,"afterLinkSeries",function(){if(b.options){var a=b.linkedParent,n=c.get(b.options.params.volumeSeriesID);b.addCustomEvents(a,n)}x()},{order:1});return b};b.prototype.addCustomEvents=function(c,a){var b=this,n=function(){b.chart.redraw();b.setData([]);b.zoneStarts=[];b.zoneLinesSVG&&(b.zoneLinesSVG=b.zoneLinesSVG.destroy())};
b.dataEventsToUnbind.push(A(c,"remove",function(){n()}));a&&b.dataEventsToUnbind.push(A(a,"remove",function(){n()}));return b};b.prototype.animate=function(c){var b=this,a=b.chart.inverted,g=b.group,m={};!c&&g&&(c=a?b.yAxis.top:b.xAxis.left,a?(g["forceAnimate:translateY"]=!0,m.translateY=c):(g["forceAnimate:translateX"]=!0,m.translateX=c),g.animate(m,G(I(b.options.animation),{step:function(c,a){b.group.attr({scaleX:Math.max(.001,a.pos)})}})))};b.prototype.drawPoints=function(){this.options.volumeDivision.enabled&&
(this.posNegVolume(!0,!0),y.drawPoints.apply(this,arguments),this.posNegVolume(!1,!1));y.drawPoints.apply(this,arguments)};b.prototype.posNegVolume=function(b,a){var c=a?["positive","negative"]:["negative","positive"],g=this.options.volumeDivision,n=this.points.length,r=[],l=[],f=0,h;b?(this.posWidths=r,this.negWidths=l):(r=this.posWidths,l=this.negWidths);for(;f<n;f++){var e=this.points[f];e[c[0]+"Graphic"]=e.graphic;e.graphic=e[c[1]+"Graphic"];if(b){var z=e.shapeArgs.width;var v=this.priceZones[f];
(h=v.wholeVolumeData)?(r.push(z/h*v.positiveVolumeData),l.push(z/h*v.negativeVolumeData)):(r.push(0),l.push(0))}e.color=a?g.styles.positiveColor:g.styles.negativeColor;e.shapeArgs.width=a?this.posWidths[f]:this.negWidths[f];e.shapeArgs.x=a?e.shapeArgs.x:this.posWidths[f]}};b.prototype.translate=function(){var b=this,a=b.options,x=b.chart,g=b.yAxis,m=g.min,r=b.options.zoneLines,l=b.priceZones,f=0,h,e,z;y.translate.apply(b);var v=b.points;if(v.length){var d=.5>a.pointPadding?a.pointPadding:.1;a=b.volumeDataArray;
var p=E(a);var q=x.plotWidth/2;var M=x.plotTop;var k=u(g.toPixels(m)-g.toPixels(m+b.rangeStep));var w=u(g.toPixels(m)-g.toPixels(m+b.rangeStep));d&&(m=u(k*(1-2*d)),f=u((k-m)/2),k=u(m));v.forEach(function(a,c){e=a.barX=a.plotX=0;z=a.plotY=g.toPixels(l[c].start)-M-(g.reversed?k-w:k)-f;h=B(q*l[c].wholeVolumeData/p);a.pointWidth=h;a.shapeArgs=b.crispCol.apply(b,[e,z,h,k]);a.volumeNeg=l[c].negativeVolumeData;a.volumePos=l[c].positiveVolumeData;a.volumeAll=l[c].wholeVolumeData});r.enabled&&b.drawZones(x,
g,b.zoneStarts,r.styles)}};b.prototype.getValues=function(b,a){var c=b.processedXData,g=b.processedYData,m=this.chart,r=a.ranges,l=[],f=[],h=[],e=m.get(a.volumeSeriesID);if(b.chart)if(e&&e.processedXData.length)if((a=K(g[0]))&&4!==g[0].length)C("Type of "+b.name+" series is different than line, OHLC or candlestick.",!0,m);else return(this.priceZones=this.specifyZones(a,c,g,r,e)).forEach(function(b,a){l.push([b.x,b.end]);f.push(l[a][0]);h.push(l[a][1])}),{values:l,xData:f,yData:h};else C("Series "+
a.volumeSeriesID+(e&&!e.processedXData.length?" does not contain any data.":" not found! Check `volumeSeriesID`."),!0,m);else C("Base series not found! In case it has been removed, add a new one.",!0,m)};b.prototype.specifyZones=function(b,a,d,g,m){if(b){var c=d.length;for(var l=d[0][3],f=l,h=1,e;h<c;h++)e=d[h][3],e<l&&(l=e),e>f&&(f=e);c={min:l,max:f}}else c=!1;h=c;c=this.zoneStarts=[];l=[];f=h?h.min:J(d);e=h?h.max:E(d);var n=0;h=1;var k=this.linkedParent;!this.options.compareToMain&&k.dataModify&&
(f=k.dataModify.modifyValue(f),e=k.dataModify.modifyValue(e));if(!F(f)||!F(e))return this.points.length&&(this.setData([]),this.zoneStarts=[],this.zoneLinesSVG&&(this.zoneLinesSVG=this.zoneLinesSVG.destroy())),[];k=this.rangeStep=B(e-f)/g;for(c.push(f);n<g-1;n++)c.push(B(c[n]+k));c.push(e);for(g=c.length;h<g;h++)l.push({index:h-1,x:a[0],start:c[h-1],end:c[h]});return this.volumePerZone(b,l,m,a,d)};b.prototype.volumePerZone=function(b,a,d,g,m){var c=this,l=d.processedXData,f=d.processedYData,h=a.length-
1,e=m.length;d=f.length;var k,n,p,t,q;u(e-d)&&(g[0]!==l[0]&&f.unshift(0),g[e-1]!==l[d-1]&&f.push(0));c.volumeDataArray=[];a.forEach(function(a){a.wholeVolumeData=0;a.positiveVolumeData=0;for(q=a.negativeVolumeData=0;q<e;q++){p=n=!1;t=b?m[q][3]:m[q];k=q?b?m[q-1][3]:m[q-1]:t;var d=c.linkedParent;!c.options.compareToMain&&d.dataModify&&(t=d.dataModify.modifyValue(t),k=d.dataModify.modifyValue(k));t<=a.start&&0===a.index&&(n=!0);t>=a.end&&a.index===h&&(p=!0);(t>a.start||n)&&(t<a.end||p)&&(a.wholeVolumeData+=
f[q],k>t?a.negativeVolumeData+=f[q]:a.positiveVolumeData+=f[q])}c.volumeDataArray.push(a.wholeVolumeData)});return a};b.prototype.drawZones=function(a,b,d,g){var c=a.renderer,k=a.plotWidth,l=a.plotTop,f=this.zoneLinesSVG,h=[],e;d.forEach(function(c){e=b.toPixels(c)-l;h=h.concat(a.renderer.crispLine([["M",0,e],["L",k,e]],g.lineWidth))});f?f.animate({d:h}):f=this.zoneLinesSVG=c.path(h).attr({"stroke-width":g.lineWidth,stroke:g.color,dashstyle:g.dashStyle,zIndex:this.group.zIndex+.1}).add(this.group)};
b.defaultOptions=L(D.defaultOptions,{params:{index:void 0,period:void 0,ranges:12,volumeSeriesID:"volume"},zoneLines:{enabled:!0,styles:{color:"#0A9AC9",dashStyle:"LongDash",lineWidth:1}},volumeDivision:{enabled:!0,styles:{positiveColor:"rgba(144, 237, 125, 0.8)",negativeColor:"rgba(244, 91, 91, 0.8)"}},animationLimit:1E3,enableMouseTracking:!1,pointPadding:0,zIndex:-1,crisp:!0,dataGrouping:{enabled:!1},dataLabels:{allowOverlap:!0,enabled:!0,format:"P: {point.volumePos:.2f} | N: {point.volumeNeg:.2f}",
padding:0,style:{fontSize:"0.5em"},verticalAlign:"top"}});return b}(D);G(b.prototype,{nameBase:"Volume by Price",nameComponents:["ranges"],calculateOn:{chart:"render",xAxis:"afterSetExtremes"},pointClass:a,markerAttribs:p,drawGraph:p,getColumnMetrics:y.getColumnMetrics,crispCol:y.crispCol});d.registerSeriesType("vbp",b);"";return b});k(a,"masters/indicators/volume-by-price.src.js",[],function(){})});
//# sourceMappingURL=volume-by-price.js.map