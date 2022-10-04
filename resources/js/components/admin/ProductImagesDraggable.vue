<template>
    <!-- <div class="img-index">
                <draggable :list="productImagesNew" ghost-class="ghost" :options="{animation: 200, handle: '.my-handle'}" @change="update" :element="'div'">


                            <div v-for="image in productImagesNew" class="d-flex w-100 my-2">
                                <img :src="'/storage/' + image.image" alt="" srcset="">
                                <form :action="'productimages/' + image.id" method="post">
                                    <input type="hidden" name="_method" value="DELETE">
                                    <input type="hidden" name="_token" :value="csrf">  
                                    
                                        <button type="submit" class="button mr-2">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                            
                                </form>
                            </div>
                </draggable>
    </div> -->











    <div class="mt-5">
        <h2>Images</h2>
    <table>
        <colgroup>
            <col>
            <col>
            <col>

        </colgroup>
        <thead>
          <tr>
            <th>Image</th>
            <th>Options</th>
            <th>Sort</th>

          </tr>
        </thead>
        <draggable :list="productImagesNew" ghost-class="ghost" :options="{animation: 200, handle: '.my-handle'}" :element="'tbody'" @change="update">
    
        <tr v-for="(image, index) in productImagesNew">
            <td><img :src="'/storage/' + image.image" alt="" srcset=""></td>
            
            <td class="d-flex">
                <form :action="'/admin/productimages/' + image.id" method="post">
                    <input type="hidden" name="_method" value="DELETE">
                    <input type="hidden" name="_token" :value="csrf">                    
                
                    <!-- @csrf -->
                        <button type="submit" class="button mr-2">
                            <i class="fas fa-trash-alt"></i>
                         </button>
            
                </form>
                <!-- <a :href="'products/' + product.id + '/edit'" class="button">
                    <button type="submit" class="button">
                            <i class="fas fa-pencil-alt"></i>                     
                    </button>
                </a> -->
            </td>
            <td>
                <i class="fas fa-bars my-handle"></i>

            </td>
        </tr>
        </draggable>
      </table>
      </div>
</template>

<script>
import draggable from 'vuedraggable'
    export default {

        components: {
            draggable
        },
        props: [
            'product',
            'productimages'

        ],
        data(){
                return{
                // product: this.product,
                productImagesNew: Object.keys(this.productimages).map(i => this.productimages[i]),

                // productImagesNew: [],
                // productimages : axios.get('/admin/productimages/index'),
                // productImagesNew: Object.keys(productimages).map(i => productimages[i]),

                // productsNew: this.products,
                csrf: document.head.querySelector('meta[name="csrf-token"]').content
                }
        },
        // mounted() {
        //     axios.get('/admin/productimages/index', {

        //         params: {
        //         productid: this.product['id']
        //         }
                
        //     })
        //     .then(response => {this.productImagesNew = response.data})
        //     // .then(function (response) {
        //     //     // handle success
        //     //     console.log(response.data);
        //     // })

        // },
        methods: {
            update() {
                // console.log('success');
                this.productImagesNew.map((productImage, index) => {
                    productImage.order = index + 1
                })

                axios.put('/admin/productimages/updateall', {
                    productimages: this.productImagesNew
                })
            }
        }
    }
</script>
