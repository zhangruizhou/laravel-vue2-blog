<template>
  <div>
    <div class="crumbs">
      <el-breadcrumb separator="/">
        <el-breadcrumb-item><i class="el-icon-document"></i> 文章管理</el-breadcrumb-item>
        <el-breadcrumb-item>添加文章</el-breadcrumb-item>
      </el-breadcrumb>
    </div>
    <div class="form-box">
      <el-form ref="form" :model="form" label-width="120">
        <el-form-item label="标题" label-width="60">
          <el-input v-model="form.title"></el-input>
        </el-form-item>
        <el-form-item label="封面图片" label-width="40">
          <el-upload-
            class="avatar-uploader"
            action="https://jsonplaceholder.typicode.com/posts/"
            :show-file-list="false"
            :on-success="handleAvatarScucess"
            :before-upload="beforeAvatarUpload">
            <img v-if="imageUrl" :src="imageUrl" class="avatar">
            <i v-else class="el-icon-plus avatar-uploader-icon"></i>
          </el-upload->
        </el-form-item>
        <el-form-item label="所属分类" label-width="60">
          <el-select v-model="form.region" placeholder="请选择">
            <el-option label="步步高" value="bbk"></el-option>
            <el-option label="小天才" value="xtc"></el-option>
            <el-option label="imoo" value="imoo"></el-option>
          </el-select>
        </el-form-item>
        <el-form-item label="简介">
          <el-input type="textarea" v-model="form.intro"></el-input>
        </el-form-item>
        <el-form-item label="内容" label-width="160">
          <markdown-editor v-model="content" :configs="configs" ref="markdownEditor"></markdown-editor>
        </el-form-item>
        <el-form-item>
          <el-button type="primary" @click="onSubmit">提交</el-button>
          <el-button>取消</el-button>
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
        form: {
          name: '',
          region: '',
          date1: '',
          date2: '',
          delivery: true,
          type: ['步步高'],
          resource: '小天才',
          desc: ''
        }
      }
    },
    methods: {
      onSubmit() {
        this.$message.success('提交成功！');
      }
    },
    components: {
      markdownEditor
    }
  }
</script>
