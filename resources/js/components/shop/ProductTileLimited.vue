<template>
    <div class="product-tile-limited" ref="productTileLimited">
        <div class="tile-content">
            <div
                class="product-image-wrapper"
                :style="
                    'background-image: url(/storage/' +
                        product.images[0].image +
                        ')'
                "
            >
                <img
                    class="product-image"
                    :src="'/storage/' + product.images[0].image"
                    alt=""
                />
            </div>
            <div class="product-information">
                <span class="title">{{ product.title }}</span>
                <span class="description" v-html="product.description"></span>
                <span v-if="stock >= 1" class="price"
                    >Po zakupieniu płyty, bluzy i notesu, krzyżyk otrzymasz
                    gratis</span
                >
                <span v-if="stock < 1" class="price"
                    >Przepraszamy... wygląda na to, że skończyły się zasoby!
                </span>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    components: {},
    props: ["product"],
    data() {
        return {
            flag: false,
            productSelected: [],
            stock: this.product.stock,
            price: this.product.price,
            productOrVariationSelected: []
        };
    },

    mounted() {
        this.$store.watch(
            state => {
                return this.$store.state.basketContent;
            },
            response => {
                if (this.price == null) {
                    this.price = 0;
                }

                var bluzaCount = 0;
                response.forEach(element => {
                    if (element.title.search("Bluza") == 0) {
                        bluzaCount++;
                    }
                });

                var noItemsForLimited =
                    response.length - Math.floor(bluzaCount / 2);

                if (noItemsForLimited >= 3 && !this.flag && this.stock >= 1) {
                    this.flag = true;
                    this.$refs.productTileLimited.classList.add("highlighted");

                    this.productSelected = {
                        id: this.product.id,
                        productOrVariant: "product",
                        title: this.product.title,
                        price: this.price
                    };

                    this.$store.commit("addToBasket", this.productSelected);
                } else if (
                    noItemsForLimited <= 3 &&
                    this.flag &&
                    this.stock >= 1
                ) {
                    this.flag = false;
                    this.$refs.productTileLimited.classList.remove(
                        "highlighted"
                    );

                    this.productOrVariationSelected.id = this.product.id;
                    this.productOrVariationSelected.productOrVariant =
                        "product";
                    this.productOrVariationSelected.title = this.product.title;
                    this.productOrVariationSelected.price = this.price;

                    this.$store.commit(
                        "removeFromBasket",
                        this.productOrVariationSelected
                    );
                } else if (this.stock < 1) {
                    this.$refs.productTileLimited.classList.remove(
                        "highlighted"
                    );
                }
            }
        );
    },

    methods: {}
};
</script>
