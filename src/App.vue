<script setup>

</script>

<template>
  <div class="welcome-screen">

    <header>
      <h3>Boilerplate Plugin:</h3>
      <h1>
        WordPress + Vue.js
      </h1>
      <div class="logos">
        <img src="./assets/wordpress-logo.png" alt="WordPress Logo">
        <img src="./assets/vue-logo.svg" alt="Vue Logo">
      </div>
    </header>

    <section>
      <h4>Welcome to the Boilerplate Plugin!</h4>
      <p>This plugin is a starting point for building a custom WordPress plugin using <a href="https://vitejs.dev/">Vue.js</a>. It includes a build setup based
        on Vite, which allows you to use modern JavaScript features and hot module reloading while developing your plugin. As
        an example of how Vue.js can be integrated within this plugin, we decide to include this admin page that uses Vue.js
        to render the content you're seeing. </p>
    </section>

      <section>
        <h4>How to use it?</h4>
        <p>There are two modes of usage for this plugin: <b>development</b> and <b>production</b>. </p>
        <p>
          To start the development server and enable hot module reloading, run in your terminal:
          <code>
            npm run dev
          </code>
        </p>
        
        <p>
          To create a production build and optimize your assets for deployment, run in your terminal:
          <code>
            npm run build
          </code>
        </p>
        <p>These two modes require no additional configuration beyond running the appropriate npm script.</p>
      </section>

      <section>
        <h4>Folder Structure</h4>
        <p>The plugin includes several folders:</p>
        <ul>
          <li><b>src</b>: This folder contains the Vue.js files for your plugin.</li>
          <li><b>build</b>: This folder contains the bundled files generated from the Vue.js files in the src folder.</li>
          <li><b>includes</b>: This folder contains PHP models, interfaces, abstract classes, exceptions, and the main plugin class.</li>
          <li><b>admin</b>: This folder contains Admin Controllers for the admin area of your site. These are singleton-based classes where you can define WordPress-specific logic, such as registering hooks, creating pages, or defining AJAX endpoints. Using singleton-based classes in the admin folder is a suggestion for organizing your code, but you are free to use whatever approach you prefer.</li>
          <li><b>public</b>: This folder contains Public Controllers for your site's front-end or public area. These are singleton-based classes where you can define WordPress-specific logic, such as registering hooks, creating pages, or defining AJAX endpoints. Using singleton-based classes in the public folder is just a suggestion for organizing your code, but you are free to use whatever approach you prefer.</li>
        </ul>
      </section>

      <section>
        <p>If you'd like to contribute to the Boilerplate Plugin, check out the <a href="https://github.com/jnfDev/boilerplate-plugin">repository</a>. Your support is greatly appreciated!</p>
      </section>
  </div>
</template>

<style scoped>
  .welcome-screen {
    background-color: #fff;
    margin: 20px 20px 20px 0;
    min-height: 600px;
    border-radius: 10px;
    padding: 52px;
  }

  .welcome-screen h3 {
    font-weight: 700;
    font-size: 2rem;
    color: #ABA3A3;
    margin-bottom: 1.5rem;
    margin-top: 0;
  }

  .welcome-screen h1 {
    font-size: 3rem;
    font-weight: 700;
    margin-top: 0;
    margin-bottom: 2rem;
    color: #000;
  }

  .welcome-screen h4 {
    font-size: 1.5rem;
    font-weight: 600;
    margin-top: 2.5rem;
    margin-bottom: 1.5rem;
    border-bottom: 1px solid #e3e3e3;
    padding-bottom: 1rem;
  }

  .welcome-screen p {
    font-size: 16px;
    line-height: 1.5;
    margin-top: 0;
    margin-bottom: 1rem;
  }

  .welcome-screen ul {
    padding-left: 20px;
    list-style: disc;
  }

  .welcome-screen li {
    font-size: 16px;
    line-height: 1.5;
    margin-bottom: .4rem;
  }
  .welcome-screen a {
    color: #ABA3A3;
    font-weight: 700;
  }

  .welcome-screen header {
    text-align: center;
  }

  .welcome-screen section {
    max-width: 1440px;
    margin: 25px auto;
  }

  .welcome-screen .logos img {
    max-height: 130px;
    margin: 10px;
  }

</style>
