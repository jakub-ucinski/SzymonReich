<template>
    <div class="mt-5" id="product-variation-categories-table">
        <div class="d-flex align-items-center justify-content-between">
            <h2>Product Variant Categories</h2>
            <a @click="addAnother" type="button" class="button">
                <i class="fas fa-plus"></i>
            </a>
        </div>
        <table class="draggable-table">
            <colgroup>
                <col />
                <col />
                <col />
            </colgroup>
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Options</th>
                    <th>Sort</th>
                </tr>
            </thead>
            <draggable
                :list="productVariationCategoriesNew"
                ghost-class="ghost"
                :options="{ animation: 200, handle: '.my-handle' }"
                :element="'tbody'"
                @change="update"
            >
                <tr
                    v-for="(variationCategory,
                    index) in productVariationCategoriesNew"
                >
                    <td>{{ variationCategory.title }}</td>

                    <td class="d-flex">
                        <form
                            :action="
                                '/admin/variationcategory/' +
                                    variationCategory.id
                            "
                            method="post"
                        >
                            <input
                                type="hidden"
                                name="_method"
                                value="DELETE"
                            />
                            <input type="hidden" name="_token" :value="csrf" />

                            <!-- @csrf -->
                            <button type="submit" class="button mr-2">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </form>
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
            </draggable>
        </table>
    </div>
</template>

<script>
import draggable from "vuedraggable";
export default {
    components: {
        draggable
    },
    props: ["product", "productvariationcategories"],
    data() {
        return {
            productVariationCategoriesNew: Object.keys(
                this.productvariationcategories
            ).map(i => this.productvariationcategories[i]),
            csrf: document.head.querySelector('meta[name="csrf-token"]').content
        };
    },
    methods: {
        update() {
            this.productVariationCategoriesNew.map(
                (productVariationCategory, index) => {
                    productVariationCategory.order = index + 1;
                }
            );

            axios.put(
                "/admin/product/" +
                    this.product.id +
                    "/variationcategory/updateall",
                {
                    productvariationcategories: this
                        .productVariationCategoriesNew
                }
            );
        },

        addAnother() {
            document.querySelector(
                "#product-variation-categories-table #hidden"
            ).style.display = "table-row";
        },

        removeLast() {
            document.querySelector(
                "#product-variation-categories-table #hidden"
            ).style.display = "none";
        },

        addLast() {
            if (typeof this.productVariationCategoriesNew == "undefined") {
                var order = 1;
            } else {
                var order = this.productVariationCategoriesNew.length;
            }
            axios
                .post(
                    "/admin/products/" + this.product.id + "/variationcategory",
                    {
                        title: document.querySelector(
                            "#product-variation-categories-table #hidden #title-input"
                        ).value,
                        order: order
                    }
                )
                .then(response =>
                    this.productVariationCategoriesNew.push(response.data)
                );

            document.querySelector(
                "#product-variation-categories-table #hidden"
            ).style.display = "none";
        }
    }
};
</script>
