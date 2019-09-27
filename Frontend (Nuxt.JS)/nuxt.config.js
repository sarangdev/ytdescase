module.exports = {
  /*
  ** Headers of the page
  */
  plugins: [
    { src: '~plugins/ga.js', ssr: false },
    { src: '~plugins/vk.js', ssr: false }
    // { src: '~plugins/animation.js', ssr: false }
  ],
  head: {
    title: 'YTDes Case - Первые кейсы с дизайном!',
    meta: [
      { charset: 'utf-8' },
      { name: 'viewport', content: 'width=device-width, initial-scale=1' },
      { hid: 'description', name: 'description', content: 'Первые кейсы с дизайном! Испытай удачу и получи лучший из призов!' },
      { hid: 'keywords', name: 'keywords', content: 'кейсы, кейс, открытие кейсов, кейсы с дизайном, дизайн, дешевые кейсы, кейсы без обмана, кейсы онлайн с деньгами' },      
      { name: 'interkassa-verification', content: '9aabd4755d2cb58acfeef39c0dbdded1' }
    ],
    link: [
      { rel: 'icon', type: 'image/png', href: '/img/favicon.png' },
      { rel: 'stylesheet', href: '/main.css' }
    ],
    script: [
      { src: 'https://code.jquery.com/jquery-3.4.1.min.js',
        type: "text/javascript" }
    ]
  },
  env: {
    baseUrl: process.env.BASE_URL,
    apiUrl: 'https://localhost/api',
    logged: false
  },
  /*
  ** Customize the progress bar color
  */
  loading: { color: '#b7355d' },
  /*
  ** Build configuration
  */
  build: {
    /*
    ** Run ESLint on save
    */
    extend (config, { isDev, isClient }) {
      if (isDev && isClient) {
        config.module.rules.push({
          enforce: 'pre',
          test: /\.(js|vue)$/,
          loader: 'eslint-loader',
          exclude: /(node_modules)/
        })
      }
    }
  }
}

