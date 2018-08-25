<template>
  <el-table
    :data="tableData"
    stripe
    style="width: 100%">
    <el-table-column
      prop="款项编码"
      align="center"
      width="150"
      label="款项编码">
    </el-table-column>
    <el-table-column
      prop="款项分类"
      align="center"
      label="款项分类">
    </el-table-column>
    <el-table-column
      prop="应付金额"
      align="center"
      label="应付金额">
  <template slot-scope="scope">
    <span style="color:#0080ff">{{scope.row.应付金额}}</span>
  </template>
    </el-table-column>
    <el-table-column
      prop="收款账号"
      align="center"
      width="150"
      label="收款账号">
    </el-table-column>
    <el-table-column
      prop="开户行"
      align="center"
      width="240"
      label="开户行">
    </el-table-column>
    <el-table-column
      prop="收款人"
      align="center"
      label="收款人">
  <template slot-scope="scope">
    <span style="color:#0080ff">{{scope.row.应付金额}}</span>
  </template>
    </el-table-column>
    <el-table-column
      prop="付款状态"
      align="center"
      label="付款状态">
  <template slot-scope="scope">
    <span style="color:#0080ff">{{scope.row.应付金额}}</span>
  </template>
    </el-table-column>
    <el-table-column
      prop="凭证回执编码"
      align="center"
      width="150"
      label="凭证回执编码">
    </el-table-column>
    <el-table-column
      prop="凭证图片附件"
      align="center"
      label="凭证图片附件">
  <template slot-scope="scope">
    <span style="color:#ff0000">{{scope.row.凭证图片附件}}</span>
  </template>
    </el-table-column>
    <el-table-column
      prop="执行人"
      align="center"
      label="执行人">
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
    <el-dropdown-item>付款确认</el-dropdown-item>
    <el-dropdown-item>核账通知</el-dropdown-item>
    <el-dropdown-item>上传凭证</el-dropdown-item>
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
      contextPath:"",
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
