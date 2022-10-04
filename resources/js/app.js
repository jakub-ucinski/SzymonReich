/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
window.Vuex = require('vuex');
/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))
Vue.component('product-images-draggable', require('./components/admin/ProductImagesDraggable.vue').default);
Vue.component('products-draggable', require('./components/admin/ProductsDraggable.vue').default);
Vue.component('products-variation-categories-draggable', require('./components/admin/ProductVariationCategoriesDraggable.vue').default);
Vue.component('products-variation-options-draggable', require('./components/admin/ProductVariationOptionsDraggable.vue').default);
Vue.component('products-variations-draggable', require('./components/admin/ProductVariationsDraggable.vue').default);
Vue.component('recommendations', require('./components/admin/Recommendations.vue').default);

Vue.component('text-editor-tip-tap', require('./components/admin/TextEditorTipTap.vue').default);

Vue.component('product-tile-standard', require('./components/shop/ProductTileStandard.vue').default);
Vue.component('product-tile-limited', require('./components/shop/ProductTileLimited.vue').default);


Vue.component('basket', require('./components/shop/Basket.vue').default);
Vue.component('order-form', require('./components/shop/OrderForm.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const store = new Vuex.Store({
    state: {
        basketContent: [],
        message: "",
    },
    mutations: {
        addToBasket(state, payload){
            state.basketContent.push(payload);
        },
        removeFromBasket(state, payload){
            // console.log(payload);
            var index = 0;
            state.basketContent.forEach((el, index) => {
                // console.log(index);
                // console.log('el: ' + el + ' || payload: ' + payload);
                // console.log(el.id);
                // console.log(payload.id);

                if (el.id==payload.id) {
                    state.basketContent.splice(index, 1);
                }
            });
            // console.log(state.basketContent.filter(function(el) { return el.title != payload.title; })); 
            // state.basketContent = tempArray;
        },
        setMessage(state, payload){
            state.message = payload;
        }
    
    },
    getters: {
        getBasketContents(state){
            return state.basketContent;
        },
        getMessage(state){
            return state.message;
        }
    }


});

// store.watch(
//     (state)=>{
//       return store.state.basketContent
//     },
//     (response)=>{
//       //something changed do something
//       console.log(response.length)
//       var productOrVariationSelected = {
//         id: this.product.id,
//         productOrVariant: 'product',
//         title: this.product.title,
//         price: this.product.price,
//         // price: 'PLN: '+(this.product.price.toString().substring(0, this.product.price.toString().length-2))+','+(this.product.price.toString().substr(this.product.price.toString().length-2,2)),

//     };
    
//       if (ressponse.length >= 2) {
        

//         store.commit('addToBasket', productOrVariationSelected);
//       }else{
//         removeFromBasket()
//       }
//     },
//     )

const app = new Vue({
    el: '#app',
    store: store,
});

require('./requires')