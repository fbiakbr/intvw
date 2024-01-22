<template>
    <div class="p-4">
        <button class="btn btn-primary" onclick="add_pegawai_modal.showModal()">
            Tambah
        </button>
        <div class="overflow-x-auto my-4">
            <table class="table">
                <thead>
                    <tr>
                        <th>NIP</th>
                        <th>Nama Pegawai</th>
                        <th>Jenis Kelamin</th>
                        <th>Tgl Lahir</th>
                        <th>Jabatan</th>
                        <th>Unit</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- row 1 -->
                    <tr
                        v-for="(pegawai, index) in data_pegawai"
                        :key="pegawai.id"
                    >
                        <td>{{ pegawai.nip }}</td>
                        <td>{{ pegawai.nama }}</td>
                        <td>{{ pegawai.jenis_kelamin }}</td>
                        <td>{{ pegawai.tanggal_lahir }}</td>
                        <td>{{ pegawai.jabatan }}</td>
                        <td>{{ pegawai.unit_kerja }}</td>
                        <td>
                            <button
                                class="btn btn-warning"
                                onclick="update_pegawai_modal.showModal()"
                                @click="clickUpdateButton(index)"
                            >
                                Edit</button
                            ><button
                                class="btn btn-error"
                                onclick="delete_pegawai_modal.showModal()"
                                @click="clickDeleteButton(index)"
                            >
                                Hapus
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <!-- Open the modal using ID.showModal() method -->
    <dialog id="add_pegawai_modal" class="modal">
        <div class="modal-box">
            <div class="divider"></div>
            <label class="form-control">
                <div class="label">
                    <span class="label-text">Nama Pegawai</span>
                </div>
                <input
                    type="text"
                    placeholder="Masukkan Nama"
                    class="input input-bordered w-full"
                    v-model="form.nama"
                />
                <div class="label">
                    <span
                        class="label-text-alt text-red-500"
                        v-if="form.nama.length == 0"
                        >Nama tidak boleh kosong!!</span
                    >
                </div>
            </label>
            <label class="form-control">
                <div class="label">
                    <span class="label-text">NIP</span>
                </div>
                <input
                    type="text"
                    placeholder="Masukkan NIP"
                    class="input input-bordered w-full"
                    v-model="form.nip"
                />
            </label>
            <label class="form-control">
                <div class="label">
                    <span class="label-text">Jenis Kelamin</span>
                </div>
                <select
                    class="select select-bordered w-full"
                    v-model="form.jenis_kelamin"
                >
                    <option disabled selected>Jenis Kelamin</option>
                    <option value="LAKI-LAKI">LAKI-LAKI</option>
                    <option value="PEREMPUAN">PEREMPUAN</option>
                </select>
            </label>
            <label class="form-control">
                <div class="label">
                    <span class="label-text">Tanggal Lahir</span>
                </div>
                <input
                    type="date"
                    placeholder="Tanggal Lahir"
                    class="input input-bordered w-full"
                    v-model="form.tanggal_lahir"
                />
            </label>
            <label class="form-control">
                <div class="label">
                    <span class="label-text">Jabatan</span>
                </div>
                <select
                    class="select select-bordered w-full"
                    v-model="form.jabatan"
                >
                    <option disabled selected>Pilih Jabatan</option>
                    <option value="KEPALA">KEPALA</option>
                    <option value="SEKRETARIS">SEKRETARIS</option>
                    <option value="STAFF">STAFF</option>
                </select>
            </label>
            <label class="form-control">
                <div class="label">
                    <span class="label-text">Unit</span>
                </div>
                <select
                    class="select select-bordered w-full"
                    v-model="form.unit_kerja"
                >
                    <option disabled selected>Pilih Unit</option>
                    <option value="IT">IT</option>
                    <option value="NON_IT">NON IT</option>
                </select>
            </label>
            <div class="divider"></div>
            <div class="flex justify-between">
                <button class="btn" onclick="add_pegawai_modal.close()">
                    Close
                </button>
                <button
                    class="btn btn-primary"
                    @click="onSubmit()"
                    onclick="add_pegawai_modal.close()"
                >
                    Tambah
                </button>
            </div>
        </div>
    </dialog>
    <dialog id="delete_pegawai_modal" class="modal">
        <div class="modal-box">
            <h1>
                Apakah anda ingin menghapus data pegawai :
                {{ data_pegawai[selectedPegawaiIndex?.toString()]?.nama }}
            </h1>
            <div class="flex justify-between my-4">
                <button
                    class="btn btn-primary"
                    onclick="delete_pegawai_modal.close()"
                >
                    Batal
                </button>
                <button
                    class="btn btn-error"
                    @click="deletePegawai(selectedPegawaiIndex.toString())"
                    onclick="delete_pegawai_modal.close()"
                >
                    Hapus
                </button>
            </div>
        </div>
    </dialog>
    <dialog id="update_pegawai_modal" class="modal">
        <div class="modal-box">
            <h1>Update Pegawai</h1>
            <div class="divider"></div>
            <label class="form-control">
                <div class="label">
                    <span class="label-text">Nama Pegawai</span>
                </div>
                <input
                    type="text"
                    placeholder="Masukkan Nama"
                    class="input input-bordered w-full"
                    v-model="update_form.nama"
                />
            </label>
            <label class="form-control">
                <div class="label">
                    <span class="label-text">NIP</span>
                </div>
                <input
                    type="text"
                    placeholder="Masukkan NIP"
                    class="input input-bordered w-full"
                    v-model="update_form.nip"
                />
            </label>
            <label class="form-control">
                <div class="label">
                    <span class="label-text">Jenis Kelamin</span>
                </div>
                <select
                    class="select select-bordered w-full"
                    v-model="update_form.jenis_kelamin"
                >
                    <option disabled selected>Jenis Kelamin</option>
                    <option value="LAKI-LAKI">LAKI-LAKI</option>
                    <option value="PEREMPUAN">PEREMPUAN</option>
                </select>
            </label>
            <label class="form-control">
                <div class="label">
                    <span class="label-text">Tanggal Lahir</span>
                </div>
                <input
                    type="date"
                    placeholder="Tanggal Lahir"
                    class="input input-bordered w-full"
                    v-model="update_form.tanggal_lahir"
                />
            </label>
            <label class="form-control">
                <div class="label">
                    <span class="label-text">Jabatan</span>
                </div>
                <select
                    class="select select-bordered w-full"
                    v-model="update_form.jabatan"
                >
                    <option disabled selected>Pilih Jabatan</option>
                    <option value="KEPALA">KEPALA</option>
                    <option value="SEKRETARIS">SEKRETARIS</option>
                    <option value="STAFF">STAFF</option>
                </select>
            </label>
            <label class="form-control">
                <div class="label">
                    <span class="label-text">Unit</span>
                </div>
                <select
                    class="select select-bordered w-full"
                    v-model="update_form.unit_kerja"
                >
                    <option disabled selected>Pilih Unit</option>
                    <option value="IT">IT</option>
                    <option value="NON_IT">NON IT</option>
                </select>
            </label>
            <div class="divider"></div>
            <div class="flex justify-between">
                <button class="btn" onclick="update_pegawai_modal.close()">
                    Close
                </button>
                <button
                    class="btn btn-primary"
                    @click="updatePegawai(selectedPegawaiIndex.toString())"
                    onclick="update_pegawai_modal.close()"
                >
                    Update
                </button>
            </div>
        </div>
    </dialog>
</template>

<script setup>
import { ref, onMounted } from "vue";
import axios from "axios";
let data_pegawai = ref([]);
let selectedPegawaiIndex = ref(0);
let form = ref({
    nama: "",
    nip: "",
    jenis_kelamin: "",
    tanggal_lahir: "",
    jabatan: "",
    unit_kerja: "",
});
let update_form = ref({
    nama: "",
    nip: "",
    jenis_kelamin: "",
    tanggal_lahir: "",
    jabatan: "",
    unit_kerja: "",
});

onMounted(() => {
    getDataPegawai();
});

const onSubmit = async () => {
    try {
        await axios.post("/api/pegawai", form.value);
        form.value = {
            nama: "",
            nip: "",
            jenis_kelamin: "",
            tanggal_lahir: "",
            jabatan: "",
            unit_kerja: "",
        };
        getDataPegawai();
    } catch (error) {
        console.error("Error submitting the form:", error);
    }
};

const clickDeleteButton = (id) => {
    selectedPegawaiIndex.value = id;
};

const clickUpdateButton = (id) => {
    selectedPegawaiIndex.value = id;
    update_form.value = { ...data_pegawai.value[id] };
};

const deletePegawai = async (index) => {
    const id = data_pegawai.value[index].id;
    await axios.delete(`/api/pegawai/${id}`);
    getDataPegawai();
};

const updatePegawai = async (index) => {
    const id = data_pegawai.value[index].id;
    await axios.put(`/api/pegawai/${id}`, update_form.value);
    getDataPegawai();
    update_form.value = {
        nama: "",
        nip: "",
        jenis_kelamin: "",
        tanggal_lahir: "",
        jabatan: "",
        unit_kerja: "",
    };
};

const getDataPegawai = async () => {
    data_pegawai.value = [];
    const response = await axios.get("/api/pegawai");
    console.log(response.data);
    data_pegawai.value = response.data;
};
</script>
