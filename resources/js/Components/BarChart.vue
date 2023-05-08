<template>
    <div>
      <canvas ref="canvas"></canvas>
    </div>
  </template>
  
  <script lang="ts">
  import { defineComponent, onMounted, PropType, ref } from 'vue'
  import Chart, { ChartData, ChartOptions } from 'chart.js'
  
  export default defineComponent({
    name: 'BarChart',
    props: {
      chartData: {
        type: Object as PropType<ChartData>,
        required: true
      },
      chartOptions: {
        type: Object as PropType<ChartOptions>,
        default: () => ({
          responsive: true,
          maintainAspectRatio: false,
          scales: {
            yAxes: [{
              ticks: {
                beginAtZero: true
              }
            }]
          }
        })
      }
    },
    setup(props) {
      const canvasRef = ref<HTMLCanvasElement | null>(null)
  
      onMounted(() => {
        if (!canvasRef.value) return
  
        const ctx = canvasRef.value.getContext('2d')
        if (!ctx) return
  
        new Chart(ctx, {
          type: 'bar',
          data: props.chartData,
          options: props.chartOptions
        })
      })
  
      return {
        canvasRef
      }
    }
  })
  </script>
  