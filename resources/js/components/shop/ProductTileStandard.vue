<template>
    <div class="product-tile-standard" ref="productTileStandard">
        <div class="buttons">
            <button
                class="plus-minus-button-product-tile"
                v-if="numberOfVariants >= 1 || product.stock > 0"
                ref="plusMinusButtonProductTile"
                @click="buttonPlusClicked"
            ></button>
            <button
                class="recommendations-button-product-tile"
                v-if="numberOfRecommendations >= 1"
                ref="recommendationsButtonProductTile"
                @click="buttonRecommendationsClicked"
            >
                <i class="far fa-comment-dots"></i>
            </button>
        </div>
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
                <div class="prices">
                    <span class="price" v-if="this.productPrice">{{
                        this.productPriceNew
                    }}</span>
                    <span class="priceold" v-if="this.productPrice">{{
                        this.productPrice
                    }}</span>
                </div>
                <span class="variations" v-if="product.stock == 0"
                    >Przepraszamy... nie posiadmy aktualnie tego produktu na
                    stanie</span
                >
            </div>
        </div>

        <div
            class="modal fade product-variants-modal"
            v-if="this.numberOfVariants > 0"
            :id="product.id"
            tabindex="-1"
            role="dialog"
            aria-labelledby="exampleModalCenterTitle"
            aria-hidden="true"
        >
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button> -->
                    <div class="modal-header">
                        <h5 class="modal-title">{{ product.title }}</h5>
                        <button
                            type="button"
                            class="close"
                            data-dismiss="modal"
                            aria-label="Close"
                        >
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <VueSlickCarousel
                            class="topSlick"
                            ref="topslick"
                            v-bind="topSlickSettings"
                            :focusOnSelect="true"
                        >
                            <div
                                class="slick-item-div"
                                v-for="image in product.images"
                            >
                                <div
                                    class="slick-img-wrapper"
                                    :style="
                                        'background-image: url(/storage/' +
                                            image.image +
                                            ')'
                                    "
                                >
                                    <img
                                        :src="'/storage/' + image.image"
                                        alt=""
                                    />
                                </div>
                            </div>
                        </VueSlickCarousel>

                        <VueSlickCarousel
                            class="bottomSlick"
                            ref="bottomslick"
                            v-bind="bottomSlickSettings"
                            :focusOnSelect="true"
                        >
                            <div
                                class="slick-item-div"
                                v-for="image in product.images"
                            >
                                <div
                                    class="slick-img-wrapper"
                                    :style="
                                        'background-image: url(/storage/' +
                                            image.image +
                                            ')'
                                    "
                                >
                                    <img
                                        :src="'/storage/' + image.image"
                                        alt=""
                                    />
                                </div>
                            </div>
                        </VueSlickCarousel>

                        <div class="variation-pickers">
                            <div
                                v-for="variationcategory in this
                                    .productvariationcategoriesnew"
                                class="input-group mb-3"
                            >
                                <label :for="'varcat' + variationcategory.id">{{
                                    variationcategory.title
                                }}</label>
                                <select
                                    class="variant-option-select w-100"
                                    @change="optionChange($event)"
                                    :id="'varcat' + variationcategory.id"
                                    ref="optionselect"
                                    :required="true"
                                    aria-label="Example select with button addon"
                                >
                                    <option :selected="true" :value="null"
                                        >Choose...</option
                                    >
                                    <option
                                        v-for="variationoption in variationcategory.varoptions"
                                        v-bind:value="variationoption.id"
                                        :value="variationoption.id"
                                        >{{ variationoption.title }}</option
                                    >
                                </select>
                            </div>
                        </div>
                        <div class="variation-information">
                            <span class="title">
                                {{
                                    variationTitle !== ""
                                        ? variationTitle
                                        : "Proszę wybrać wariant"
                                }}
                            </span>
                            <span
                                v-if="this.variationPrice !== null"
                                class="price"
                            >
                                {{ variationPrice }}
                            </span>
                        </div>
                        <button
                            v-if="showButton"
                            class="add-variant-button"
                            @click="buttonVariantClicked"
                        >
                            Dodaj do koszyka
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div
            class="modal fade recommendations-modal"
            v-if="this.numberOfRecommendations > 0"
            :id="'recommendationmodal' + product.id"
            tabindex="-1"
            role="dialog"
            aria-labelledby="exampleModalCenterTitle"
            aria-hidden="true"
        >
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button> -->
                    <div class="modal-header">
                        <h5 class="modal-title">
                            {{ product.title }} - rekomendacje
                        </h5>
                        <button
                            type="button"
                            class="close"
                            data-dismiss="modal"
                            aria-label="Close"
                        >
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div
                            v-for="recommendation in this
                                .productrecommendations"
                            class="recommendation"
                        >
                            <div class="img-name-div">
                                <div
                                    class="recommendation-img"
                                    :style="
                                        'background-image: url(/storage/' +
                                            recommendation.image +
                                            ')'
                                    "
                                >
                                    <!-- <img :src="'/storage/'+recommendation.image" alt="" srcset=""> -->
                                </div>
                                <div class="recommendation-name">
                                    {{ recommendation.name }}
                                </div>
                            </div>
                            <div class="recommendation-description">
                                {{ recommendation.description }}
                            </div>
                        </div>
                    </div>
                    <!-- <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div> -->
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import VueSlickCarousel from "vue-slick-carousel";
// optional style for arrows & dots
import "vue-slick-carousel/dist/vue-slick-carousel-theme.css";
// import Basket from './Basket'

export default {
    components: {
        VueSlickCarousel
    },
    props: [
        "product",
        "productvariationcategories",
        "productvariations",
        "productrecommendations"
    ],
    data() {
        return {
            description: this.product.description,
            productOrVariationSelected: [],
            showButton: false,
            variationTitle: "",
            variationPrice: null,
            stock: this.product.stock,
            productvariationcategoriesnew: this.productvariationcategories,
            selected: "Choose...",
            topSlickSettings: {
                fade: true,
                infinite: true,
                speed: 500,
                slidesToShow: 1,
                slidesToScroll: 1,
                arrows: false,
                dots: false,
                asNavFor: null
            },
            bottomSlickSettings: {
                arrows: true,
                slidesToShow: 2,

                dots: true,
                asNavFor: null
                // slidesToShow:"4"
            },
            numberOfVariants:
                this.productvariations !== null
                    ? this.productvariations.length
                    : 0,
            numberOfRecommendations:
                this.productrecommendations !== null
                    ? this.productrecommendations.length
                    : 0,

            productPrice:
                this.product.price !== null
                    ? "PLN: " +
                      this.product.price
                          .toString()
                          .substring(
                              0,
                              this.product.price.toString().length - 2
                          ) +
                      "," +
                      this.product.price
                          .toString()
                          .substr(this.product.price.toString().length - 2, 2)
                    : null,

            productPriceNew:
                this.product.price !== null
                    ? "PLN: " +
                      (this.product.price * 0.9)
                          .toString()
                          .substring(
                              0,
                              this.product.price.toString().length - 2
                          ) +
                      "," +
                      (this.product.price * 0.9)
                          .toString()
                          .substr(this.product.price.toString().length - 2, 2)
                    : null
        };
    },

    mounted() {
        this.topSlickSettings.asNavFor = this.$refs.bottomslick;
        this.bottomSlickSettings.asNavFor = this.$refs.topslick;
    },

    methods: {
        buttonPlusClicked(event) {
            if (this.productvariations.length > 0) {
                if (
                    !this.$refs.plusMinusButtonProductTile.classList.contains(
                        "clicked"
                    )
                ) {
                    $(
                        ".modal.product-variants-modal#" + this.product.id
                    ).modal();
                } else {
                    this.$refs.plusMinusButtonProductTile.classList.remove(
                        "clicked"
                    );
                    this.$refs.productTileStandard.classList.remove(
                        "highlighted"
                    );
                    this.$store.commit(
                        "removeFromBasket",
                        this.productOrVariationSelected
                    );
                }
            } else {
                if (
                    !this.$refs.plusMinusButtonProductTile.classList.contains(
                        "clicked"
                    )
                ) {
                    this.productOrVariationSelected = this.product;
                    this.productOrVariationSelected = {
                        id: this.product.id,
                        productOrVariant: "product",
                        title: this.product.title,
                        price: this.product.price * 0.9
                    };

                    this.$store.commit(
                        "addToBasket",
                        this.productOrVariationSelected
                    );
                    event.target.classList.add("clicked");
                    event.target.parentElement.parentElement.classList.add(
                        "highlighted"
                    );
                } else {
                    this.$store.commit(
                        "removeFromBasket",
                        this.productOrVariationSelected
                    );
                    event.target.classList.remove("clicked");
                    event.target.parentElement.parentElement.classList.remove(
                        "highlighted"
                    );
                }
            }
        },
        buttonRecommendationsClicked(event) {
            if (
                !this.$refs.recommendationsButtonProductTile.classList.contains(
                    "clicked"
                )
            ) {
                $(
                    ".modal.recommendations-modal#recommendationmodal" +
                        this.product.id
                ).modal();
            } else {
                this.$refs.recommendationsButtonProductTile.classList.remove(
                    "clicked"
                );
            }
        },

        optionChange(event) {
            var flag = false;

            var optionselectvalues = [];
            this.$refs.optionselect.forEach(optionselect => {
                if (optionselect.value == "") {
                    flag = true;
                }
                optionselectvalues.push(optionselect.value);
            });

            if (!flag) {
                axios
                    .post("/variations", {
                        productvariationcategories: this
                            .productvariationcategories,
                        optionselectvalues: optionselectvalues
                    })
                    .then(response => {
                        this.productOrVariationSelected = response.data;
                        this.productOrVariationSelected.price = Math.floor(
                            response.data.price * 0.9
                        );

                        if (response.data.stock >= 1) {
                            this.showButton = true;
                            this.variationPrice =
                                "PLN: " +
                                this.productOrVariationSelected.price
                                    .toString()
                                    .substring(
                                        0,
                                        response.data.price.toString().length -
                                            2
                                    ) +
                                "," +
                                this.productOrVariationSelected.price
                                    .toString()
                                    .substr(
                                        response.data.price.toString().length -
                                            2,
                                        2
                                    );
                            this.variationTitle = this.productOrVariationSelected.title;
                        } else {
                            this.variationPrice = null;
                            this.variationTitle =
                                "Przepraszamy... nie posiadmy aktualnie tego wariantu na stanie";
                            this.showButton = false;
                        }
                    })
                    .catch(response => {
                        this.productOrVariationSelected = [];
                        this.variationPrice = null;
                        this.variationTitle =
                            "Przepraszamy... wygląda na to, że nie posiadamy takiego wariantu";
                        this.showButton = false;
                    });
            }
        },

        buttonVariantClicked() {
            $(".modal#" + this.product.id).modal("hide");

            this.$refs.plusMinusButtonProductTile.classList.add("clicked");
            this.$refs.productTileStandard.classList.add("highlighted");
            var productVariationSelected = this.productOrVariationSelected;

            this.productOrVariationSelected = {
                id: productVariationSelected.id,
                productOrVariant: "variant",
                title: productVariationSelected.title,
                price: productVariationSelected.price
            };

            this.$store.commit("addToBasket", this.productOrVariationSelected);
        }
    }
};
</script>
