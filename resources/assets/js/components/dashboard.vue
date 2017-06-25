<template>
<div>
  <vue-highcharts :options="options" ref="lineCharts"></vue-highcharts>
  </div>
</template>
<script>
import VueHighcharts from 'vue2-highcharts'

export default{
    components: {
        VueHighcharts
    },
    data(){
      return{
        options: {
          chart: {
            type: 'spline'
          },
          title: {
            text: 'Active Users in Onboarding Processes Weekly Basis'
          },
          xAxis: {
            title: {
              text: 'Onboarding process completion percentage %'
            },
            labels: {
              formatter: function () {
                return this.value;
              }
            },
            max:100
          },
          yAxis: {
            title: {
              text: 'Active User Percentage %'
            },
            reversed: false,
            labels: {
              formatter: function () {
                return this.value;
              }
            },
            max:100
          },
          tooltip: {
            crosshairs: true,
            shared: true
          },
          credits: {
            enabled: false
          },
          plotOptions: {
            spline: {
              marker: {
                enabled: false
              }
            }
          },

        legend: {
            title: {
                text: 'Start Date of the Week',
                style: {
                    fontWeight: 'bold'
                }
            },
            borderWidth: 2
        },
          series: []
        }
      }
    },
    mounted() {
      var me = this;
          let lineCharts = me.$refs.lineCharts;
          lineCharts.delegateMethod('showLoading', 'Loading...');
      axios.get('/dashboard').then(function(response){
          $.each(response.data , function(key, value){
            lineCharts.addSeries(value)
          });
          lineCharts.hideLoading();
      });
    }
}
</script>