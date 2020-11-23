<template>
  <q-item
    v-if="visible"
    clickable
    tag="a"
    :href="link"
    @click="handleClick(click)"
  >
    <q-item-section
      v-if="icon"
      avatar
    >
      <q-icon :name="icon" />
    </q-item-section>

    <q-item-section>
      <q-item-label>{{ title }}</q-item-label>
    </q-item-section>
  </q-item>
</template>

<script>
export default {
  name: 'EssentialLink',
  props: {
    title: {
      type: String,
      required: true
    },

    caption: {
      type: String,
      default: ''
    },

    link: {
      default: false
    },

    click: {
      default: false
    },

    icon: {
      type: String,
      default: ''
    },

    visible: {
      type: Boolean,
      default: true
    }

  },
  methods: {
    handleClick (event) {
      if (event) {
        this.$root.$emit(event, true)
      }
    }
  }
}
</script>
