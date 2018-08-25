<template>
  <el-table
    :data="tableData"
    stripe
    style="width: 100%">

    <el-table-column
      prop="type"
      align="center"
      label="卡券类型">
    </el-table-column>
    <el-table-column
      prop="code"
      align="center"
      width="150"
      label="卡券编码">
    </el-table-column>
    <el-table-column
      prop="address"
      align="center"
      label="核销状态">
  <template slot-scope="scope">
    <span style="color:#0080ff">{{scope.row.核销状态}}</span>
  </template>
    </el-table-column>
    <el-table-column
      prop="address"
      align="center"
      label="客户名称"
      width="180">
      <template slot-scope="scope">
        <span style="display:block;">福建运通星财务管理有限公司</span>
      </template>
    </el-table-column>
    <el-table-column
      prop="type2"
      align="center"
      width="110"
      label="礼券名称">
  <template slot-scope="scope">
    <span style="color:#0080ff">{{scope.row.礼券名称}}</span>
  </template>
    </el-table-column>
    <el-table-column
      prop="name"
      align="center"
      label="提货商品"
       width="160">
  <template slot-scope="scope">
    <span style="color:#00a200">{{scope.row.提货商品}}</span>
  </template>
    </el-table-column>
    <el-table-column
      prop="address"
      align="center"
      label="配送地址"
      width="210">
  <template slot-scope="scope">
    <span style="color:#0080ff">{{scope.row.配送地址}}</span>
  </template>
    </el-table-column>

    <el-table-column
      prop="address"
      align="center"
      label="收件人"
      width="160">
      <template slot-scope="scope">
        <span style="display:block;">欧阳雨木</span>
      </template>
    </el-table-column>
    <el-table-column
      prop="address"
      align="center"
      label="联系电话">
      <template slot-scope="scope">
          <span style="display:block;">133 0591 8888</span>
      </template>
    </el-table-column>
    <el-table-column
      prop="address"
      align="center"
      label="配送时段">
  <template slot-scope="scope">
    <span style="color:#0080ff">{{scope.row.配送时段}}</span>
  </template>
    </el-table-column>
    <el-table-column
      prop="address"
      align="center"
      label="核销人">
      <template slot-scope="scope">
        <span style="display:block;">591001</span>
        <span style="display:block;">慕荣晓晓</span>
      </template>
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
    <el-dropdown-item>卡券验证</el-dropdown-item>
    <el-dropdown-item>刷新</el-dropdown-item>
    <el-dropdown-item>验证重置</el-dropdown-item>
    <el-dropdown-item>废弃本券</el-dropdown-item>
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
