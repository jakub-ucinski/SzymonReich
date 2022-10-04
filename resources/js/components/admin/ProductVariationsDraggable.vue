<template>
    <div class="mt-5" id="product-variations-table">
        <div class="d-flex align-items-center justify-content-between">
            <h2>Product Variations</h2>
            <a @click="addAnother" type="button" class="button">
                <i class="fas fa-plus"></i>
            </a>
        </div>
        <table class="draggable-table">
            <colgroup>
                <col />
                <col />
                <col />
                <col />
                <col />
                <col
                    v-for="variationCategory in this
                        .productVariationCategoriesNew"
                />
            </colgroup>
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Price</th>
                    <th>Stock</th>
                    <th
                        v-for="variationCategory in this
                            .productVariationCategoriesNew"
                    >
                        {{ variationCategory.title }}
                    </th>
                    <th>Options</th>
                    <th>Sort</th>
                </tr>
            </thead>
            <tr v-for="(variation, index) in this.productVariationsNew">
                <td>{{ variation.title }}</td>
                <td>{{ variation.price }}</td>
                <td>{{ variation.stock }}</td>

                <td v-for="variationoption in productvariationoptions[index]">
                    {{ variationoption.title }}
                </td>

                <td class="d-flex">
                    <form
                        :action="'/admin/variation/' + variation.id"
                        method="post"
                    >
                        <input type="hidden" name="_method" value="DELETE" />
                        <input type="hidden" name="_token" :value="csrf" />
                        <!-- @csrf -->
                        <button type="submit" class="button mr-2">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    </form>

                    <a
                        class="button mr-2"
                        :href="'/admin/variation/' + variation.id + '/edit'"
                    >
                        <i class="fas fa-pen"></i>
                    </a>
                </td>
                <td>
                    <i class="fas fa-bars my-handle"></i>
                </td>
            </tr>

            <tr id="hidden" style="display:none;">
                <td>
                    <div class="input-group mb-3">
                        <input
                            name="title"
                            id="title-input"
                            type="text"
                            class="form-control"
                            placeholder="Title"
                            aria-label="Title"
                            aria-describedby="basic-addon1"
                        />
                    </div>
                </td>

                <td>
                    <div class="input-group mb-3">
                        <input
                            name="price"
                            id="price-input"
                            type="number"
                            class="form-control"
                            placeholder="Price"
                            aria-label="Price"
                            aria-describedby="basic-addon1"
                        />
                    </div>
                </td>

                <td>
                    <div class="input-group mb-3">
                        <input
                            name="stock"
                            id="stock-input"
                            type="number"
                            class="form-control"
                            placeholder="Stock"
                            aria-label="Stock"
                            aria-describedby="basic-addon1"
                        />
                    </div>
                </td>

                <td
                    v-for="variationCategory in this.productvariationcategories"
                >
                    <div class="input-group mb-3">
                        <select
                            class="custom-select"
                            id="variationOptions"
                            aria-label="Example select with button addon"
                        >
                            <option
                                v-for="variationOption in variationCategory.variation_options"
                                :category="variationCategory.id"
                                :value="variationOption.id"
                                >{{ variationOption.title }}</option
                            >
                        </select>
                    </div>
                </td>

                <td class="d-flex">
                    <button
                        @click="addLast()"
                        type="submit"
                        class="button mr-2"
                    >
                        <i class="fas fa-plus"></i>
                    </button>

                    <button
                        @click="removeLast()"
                        type="submit"
                        class="button mr-2"
                    >
                        <i class="fas fa-trash-alt"></i>
                    </button>
                </td>
                <td>
                    <i class="fas fa-bars my-handle"></i>
                </td>
            </tr>
        </table>
    </div>
</template>

<script>
import draggable from "vuedraggable";
export default {
    components: {
        draggable
    },
    props: [
        "product",
        "productvariationcategories",
        "productvariations",
        "productvariationoptions"
    ],
    data() {
        return {
            productVariationsNew: Object.keys(this.productvariations).map(
                i => this.productvariations[i]
            ),
            productVariationCategoriesNew: Object.keys(
                this.productvariationcategories
            ).map(i => this.productvariationcategories[i]),
            csrf: document.head.querySelector('meta[name="csrf-token"]').content
        };
    },
    methods: {
        update() {},

        addAnother() {
            document.querySelector(
                "#product-variations-table #hidden"
            ).style.display = "table-row";
        },

        removeLast() {
            document.querySelector(
                "#product-variations-table #hidden"
            ).style.display = "none";
        },

        addLast() {
            if (typeof this.productVariations == "undefined") {
                var order = 1;
            } else {
                var order = this.productVariations.length;
            }
            var OptionsArray = [];
            document
                .querySelectorAll(
                    "#product-variations-table #hidden #variationOptions"
                )
                .forEach(element => {
                    OptionsArray.push(element.value);
                });

            axios
                .post("/admin/products/" + this.product.id + "/variation", {
                    title: document.querySelector(
                        "#product-variations-table #hidden #title-input"
                    ).value,
                    price: document.querySelector(
                        "#product-variations-table #hidden #price-input"
                    ).value,
                    stock: document.querySelector(
                        "#product-variations-table #hidden #stock-input"
                    ).value,
                    options: OptionsArray,
                    order: order
                })
                .then(response =>
                    this.productVariationCategoriesNew.push(response.data)
                );

            document.querySelector(
                "#product-variations-table #hidden"
            ).style.display = "none";
        }
    }
};
</script>
