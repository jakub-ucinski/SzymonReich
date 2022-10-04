<template>
    <table>
        <colgroup>
            <col>
            <col>
            <col>
            <col>
            <col>
            <col>
            <col>
            <col>

        </colgroup>
        <thead>
          <tr>
            <th>Title</th>
            <th>Description</th>
            <!-- <th>Price</th> -->
            <th>Images</th>
            <!-- <th>Stock</th> -->
            <th>Limited</th>
            <th>Options</th>
            <th>Sort</th>

          </tr>
        </thead>
        <draggable :list="productsNew" ghost-class="ghost" :options="{animation: 200, handle: '.my-handle'}" :element="'tbody'" @change="update">
    
        <tr v-for="(product, index) in productsNew">
            <td>{{product.title}}</td>
            <td>{{product.description}}</td>
            <!-- <td>{{product.price}}</td> -->
            <td>
                <img v-for="image in product.images" class="m-2" :src="'/storage/' + image.image" alt="" srcset="">
            </td>
    
            <!-- <td>{{product.stock}}</td> -->
            <td v-if="product.limited">true</td>
            <td v-else>false</td>
            <td class="d-flex">
                <form :action="'products/' + product.id" method="post">
                    <input type="hidden" name="_method" value="DELETE">
                    <input type="hidden" name="_token" :value="csrf">                    
                
                    <!-- @csrf -->
                        <button type="submit" class="button mr-2">
                            <i class="fas fa-trash-alt"></i>
                         </button>
            
                </form>
                <a :href="'products/' + product.id + '/edit'" class="button">
                    <button type="submit" class="button">
                            <i class="fas fa-pencil-alt"></i>                     
                    </button>
                </a>
            </td>
            <td>
                <i class="fas fa-bars my-handle"></i>

            </td>
        </tr>
        </draggable>
      </table>
</template>

<script>
import draggable from 'vuedraggable'
    export default {

        components: {
            draggable
        },
        props: [
            'products'
        ],
        data(){
            return{
                productsNew: Object.keys(this.products).map(i => this.products[i]),

                // productsNew: this.products,
                csrf: document.head.querySelector('meta[name="csrf-token"]').content
            }
        },
        methods: {
            update() {
                // console.log('success');
                this.productsNew.map((product, index) => {
                    product.order = index + 1
                })

                axios.put('/admin/products/updateall', {
                    csrf: document.head.querySelector('meta[name="csrf-token"]').content,
                    products: this.productsNew
                })
            }
        }
    }
</script>
