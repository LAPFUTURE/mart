<template>
  <el-table
    :data="tableData"
    stripe
    style="width: 100%">
    <el-table-column
      prop="员工编码"
      align="center"
      width="150"
      label="员工编码">
    </el-table-column>
    <el-table-column
      prop="用户ID"
      align="center"
      label="用户ID">
  <template slot-scope="scope">
    <span style="color:#0080ff">{{scope.row.用户ID}}</span>
  </template>
    </el-table-column>
    <el-table-column
      prop="姓名"
      align="center"
      label="姓名">
  <template slot-scope="scope">
    <span style="color:#0080ff">{{scope.row.姓名}}</span>
  </template>
    </el-table-column>
    <el-table-column
      prop="就职部门"
      align="center"
      label="就职部门">
    </el-table-column>
    <el-table-column
      prop="岗位名称"
      align="center"
      label="岗位名称">
  <template slot-scope="scope">
    <span style="color:#0080ff">{{scope.row.岗位名称}}</span>
  </template>
    </el-table-column>
    <el-table-column
      prop="岗位职级"
      align="center"
      label="岗位职级">
    </el-table-column>
    <el-table-column
      prop="联系电话"
      align="center"
      label="联系电话">
    </el-table-column>
    <el-table-column
      prop="电子邮箱"
      align="center"
      width="160"
      label="电子邮箱">
    </el-table-column>
    <el-table-column
      prop="页面名称"
      align="center"
      label="页面名称">
  <template slot-scope="scope">
    <span style="color:#0080ff">{{scope.row.页面名称}}</span>
  </template>
    </el-table-column>
    <el-table-column
      prop="授权控件"
      align="center"
      label="授权控件">
  <template slot-scope="scope">
    <span style="color:#0080ff">{{scope.row.授权控件}}</span>
  </template>
    </el-table-column>
    <el-table-column
      prop="授权人"
      align="center"
      label="授权人">
    </el-table-column>
    <el-table-column
    align="center"
      label="操作">
      <template slot-scope="scope">
<el-dropdown trigger="click" placement="bottom">
  <span class="el-dropdown-link">
    <i class="el-icon-arrow-down el-icon--right"></i>
  </span>
  <el-dropdown-menu slot="dropdown" >
    <el-dropdown-item>解除授权</el-dropdown-item>
    <el-dropdown-item>添加授权</el-dropdown-item>
    <el-dropdown-item>移除人员</el-dropdown-item>
  </el-dropdown-menu>
</el-dropdown>
      </template>
    </el-table-column>
  </el-table>
</template>

<script>
  export default {
    data() {
      return {
        tableData: [{
          code: '20180221059100001',
          type: '提货券',
          type2: '运通星 中秋礼券',
          name:"阳澄湖大闸蟹 200g x 5 01803061001",
        }]
      }
    }
  }
</script>
