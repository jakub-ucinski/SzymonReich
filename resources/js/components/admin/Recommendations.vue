<template>
    <div class="mt-5" id="product-recommendation-table">
        <div class="d-flex align-items-center justify-content-between">
            <h2>Recommendations</h2>
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
            </colgroup>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Image</th>

                    <th>Options</th>
                </tr>
            </thead>

            <tr v-for="(recommendation, index) in productRecommendationsNew">
                <td>{{ recommendation.name }}</td>
                <td>{{ recommendation.description }}</td>
                <td>
                    <img
                        :src="'/storage/' + recommendation.image"
                        alt=""
                        srcset=""
                    />
                </td>

                <td class="d-flex">
                    <form
                        :action="'/admin/recommendation/' + recommendation.id"
                        method="post"
                    >
                        <input type="hidden" name="_method" value="DELETE" />
                        <input type="hidden" name="_token" :value="csrf" />

                        <!-- @csrf -->
                        <button type="submit" class="button mr-2">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    </form>
                </td>
            </tr>

            <tr id="hidden" style="display:none;">
                <td>
                    <div class="input-group mb-3">
                        <input
                            name="name"
                            id="name-input"
                            type="text"
                            class="form-control"
                            placeholder="Name"
                            aria-label="Name"
                            aria-describedby="basic-addon1"
                        />
                    </div>
                </td>

                <td>
                    <textarea
                        id="description-input"
                        type="text"
                        name="description"
                        rows="6"
                        autofocus
                    ></textarea>
                </td>

                <td>
                    <input type="file" name="image" id="image" ref="image" />
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
    props: ["product", "productrecommendations"],
    data() {
        return {
            productRecommendationsNew: Object.keys(
                this.productrecommendations
            ).map(i => this.productrecommendations[i]),
            csrf: document.head.querySelector('meta[name="csrf-token"]').content
        };
    },
    methods: {
        addAnother() {
            document.querySelector(
                "#product-recommendation-table #hidden"
            ).style.display = "table-row";
        },

        removeLast() {
            document.querySelector(
                "#product-recommendation-table #hidden"
            ).style.display = "none";
        },

        addLast() {
            var imageData = this.$refs.image.files[0];
            var formData = new FormData();

            formData.append(
                "name",
                document.querySelector(
                    "#product-recommendation-table #hidden #name-input"
                ).value
            );
            formData.append(
                "description",
                document.querySelector(
                    "#product-recommendation-table #hidden #description-input"
                ).value
            );
            formData.append("image", imageData);

            const config = {
                headers: { "Content-Type": "multipart/form-data" }
            };

            axios
                .post(
                    "/admin/products/" + this.product.id + "/recommendation",
                    formData,
                    config
                )
                .then(response =>
                    this.productRecommendationsNew.push(response.data)
                );

            document.querySelector(
                "#product-recommendation-table #hidden"
            ).style.display = "none";
        }
    }
};
</script>
