<template>
  <div class="table">
    <div class="crumbs">
      <el-breadcrumb separator="/">
        <el-breadcrumb-item><i class="el-icon-document"></i> 文章管理</el-breadcrumb-item>
        <el-breadcrumb-item>文章列表</el-breadcrumb-item>
      </el-breadcrumb>
    </div>

    <el-table :data="articles" border style="width: 100%">
      <el-table-column prop="title" label="标题" width="200">
      </el-table-column>
      <el-table-column prop="author" label="作者" width="120">
      </el-table-column>
      <el-table-column prop="category" label="分类" width="120">
      </el-table-column>
      <el-table-column prop="created_at" label="日期" width="240">
      </el-table-column>
      <el-table-column label="操作" width="180">
        <template scope="scope">
          <el-button size="small"
                     @click="handleEdit(scope.$index, scope.row)">编辑</el-button>
          <el-button size="small" type="danger"
                     @click="handleDelete(scope.$index, scope.row)">删除</el-button>
        </template>
      </el-table-column>
    </el-table>
    <div class="pagination">
      <el-pagination
        layout="prev, pager, next"
        :total="1000">
      </el-pagination>
    </div>
  </div>
</template>

<script>
  export default {
    data() {
      return {
        articles: []
      }
    },
    created() {
      const apiUrl = 'http://www.zhangruizhou.com/api/admin'
      this.$http.get(apiUrl+'/articles').then((response) => {
        response = response.body
        if (response.status === 1) {
          this.articles = response.data.list;
          console.log("ok")
        }
      })
    },
    methods: {
      formatter(row, column) {
        return row.address;
      },
      filterTag(value, row) {
        return row.tag === value;
      },
      handleEdit(index, row) {
        this.$message('编辑第'+(index+1)+'行');
      },
      handleDelete(index, row) {
        this.$message.error('删除第'+(index+1)+'行');
      }
    }
  }
</script>
