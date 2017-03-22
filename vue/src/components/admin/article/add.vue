<template>
  <div>
    <div class="crumbs">
      <el-breadcrumb separator="/">
        <el-breadcrumb-item><i class="el-icon-document"></i> 文章管理</el-breadcrumb-item>
        <el-breadcrumb-item>添加文章</el-breadcrumb-item>
      </el-breadcrumb>
    </div>
    <div class="form-box">
      <el-form ref="ruleForm" :model="ruleForm" :rules="rules" label-position="labelPosition" label-width="90px">
        <el-form-item label="标题" prop="title">
          <el-input v-model="ruleForm.title"></el-input>
        </el-form-item>
        <el-form-item label="封面图片" prop="cover">
          <el-upload
            class="avatar-uploader"
            name="photo"
            :action="actionUrl"
            :on-success="handleAvatarSuccess"
            :before-upload="beforeAvatarUpload"
            :show-file-list="false">
            <img v-if="imageUrl" :src="imageUrl" class="avatar">
            <i v-else class="el-icon-plus avatar-uploader-icon"></i>
          </el-upload>
        </el-form-item>
        <el-form-item label="所属分类" prop="category_id">
          <el-select v-model="ruleForm.category_id" placeholder="请选择">
            <el-option
              v-for="item of category"
              :label="item.name"
              :value="item.id">
            </el-option>
          </el-select>
        </el-form-item>
        <el-form-item label="简介" prop="intro">
          <el-input type="textarea" v-model="ruleForm.intro"></el-input>
        </el-form-item>
        <el-form-item label="内容" prop="content">
          <markdown-editor v-model="ruleForm.content"  ref="markdownEditor"></markdown-editor>
        </el-form-item>
        <el-form-item>
          <el-button type="primary" @click="submitForm('ruleForm')">提交</el-button>
          <el-button @click="resetForm('ruleForm')">重置</el-button>
        </el-form-item>
      </el-form>
    </div>

  </div>
</template>
<script>
  import { markdownEditor } from 'vue-simplemde';
  export default {
    data: function(){
      return {
        ruleForm: {
          title: '',
          cover: '',
          category_id: '',
          intro: '',
          content: '',
        },
        rules: {
          title: [
            { required: true, message: '请输入标题', trigger: 'blur' }
          ],
          category_id: [
            { type:'number', required: true, message: '请选择分类', trigger: 'change' }
          ],
          cover: [
            { required: true, message: '请上封面图片', trigger: 'blur' }
          ],
          intro: [
            { required: true, message: '请填写简介', trigger: 'blur' }
          ],
          content: [
            { required: true, message: '请填写内容', trigger: 'blur' }
          ],
        },
        category:[],
        imageUrl: '',
        labelPosition: 'left',
        actionUrl: BACKENDAPIURL + 'upload',
      }
    },
    created() {
      this.$http.get(BACKENDAPIURL +'category').then((response) => {
        response = response.body
        if (response.status === 1) {
          this.category = response.data.category;
        }
      })
    },
    methods: {
      submitForm(formName) {
        this.$refs[formName].validate((valid) => {
          if (valid) {
            const postData = this.ruleForm;
            this.$http.post(BACKENDAPIURL+'article', postData).then((response) => {
              response = response.body
              if (response.status == 1) {
                this.$message.success('提交成功！');
                this.$message({
                  message: '提交成功！',
                  type: 'success',
                  onClose: function () {
                    const url = '#/admin/article';
                    location = url;
                  }
                });
              } else {
                this.$message.error(response.message);
              }
            }, (response)=>{
              this.$message.error(response.body.message);
            })
          } else {
            return false;
          }
        });
      },
      resetForm(formName) {
        this.$refs[formName].resetFields();
      },
      getArticle(){
        const id = parseInt(this.$route.params.id);
        if(id > 0) {
          this.$http.get(BACKENDAPIURL + 'article/' + this.$route.params.id).then((response) => {
            response = response.body
            if (response.status === 1) {
              this.ruleForm = response.data.article;
            }
          });
        }
      },
      handleAvatarSuccess(response, file) {
        if (response.status == 1) {
          this.imageUrl = response.data.photo_url;
        } else {
          this.$message.error(response.message);
        }
      },
      beforeAvatarUpload(file) {
        const isLt2M = file.size / 1024 / 1024 < 2;
        if (!isLt2M) {
          this.$message.error('上传头像图片大小不能超过 2MB!');
        }
        return isLt2M;
      }
    },
    components: {
      markdownEditor
    }
  }
</script>
